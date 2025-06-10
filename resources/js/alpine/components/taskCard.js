export function taskCard(taskId) {
    return {
        isEditing: false,
        loading: false,
        taskId: taskId,

        // Get data from Alpine store using taskId
        get task() {
            return this.$store.taskManager.tasks.find(t => t.id === this.taskId);
        },

        async toggleTaskStatus() {
            // OPTIMISTIC UPDATE - Update UI immediately
            const originalStatus = this.task.completed;
            this.$store.taskManager.toggleTask(this.taskId);
            
            try {
                const response = await fetch(`/tasks/${this.taskId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                const data = await response.json();

                if (!data.success) {
                    // ROLLBACK - Revert optimistic update on failure
                    this.$store.taskManager.toggleTask(this.taskId);
                    alert('Failed to update task status. Please try again.');
                }
                // If successful, optimistic update was correct - no action needed
            } catch (error) {
                // ROLLBACK - Revert optimistic update on error
                this.$store.taskManager.toggleTask(this.taskId);
                console.error('Error toggling task status:', error);
                alert('Network error. Please check your connection.');
            }
        },

        async updateTask() {
            // Show loading state for updates
            this.loading = true;
            
            try {
                const form = this.$refs.editForm;
                const formData = new FormData(form);

                // OPTIMISTIC UPDATE - Update store immediately
                const newData = {
                    title: formData.get('title'),
                    description: formData.get('description'),
                    completed: formData.has('completed')
                };
                
                const originalTask = { ...this.task };
                this.$store.taskManager.updateTask(this.taskId, newData);
                this.isEditing = false; // Close edit form immediately

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Update with server response (might have additional fields)
                    this.$store.taskManager.updateTask(data.task.id, data.task);
                } else {
                    // ROLLBACK - Restore original data
                    this.$store.taskManager.updateTask(this.taskId, originalTask);
                    this.isEditing = true; // Reopen edit form
                    alert('Failed to update task. Please try again.');
                }
                
            } catch (error) {
                // ROLLBACK - Restore original data
                const originalTask = this.$store.taskManager.tasks.find(t => t.id === this.taskId);
                if (originalTask) {
                    this.$store.taskManager.updateTask(this.taskId, originalTask);
                }
                this.isEditing = true; // Reopen edit form
                console.error('Error updating task:', error);
                alert('Network error. Please try again.');
            } finally {
                this.loading = false;
            }
        },

        // Delete Task
        async deleteTask() {
            if (!confirm('Are you sure you want to delete this task?')) {
                return;
            }
            
            try {
                const response = await fetch(`/tasks/${this.taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.$store.taskManager.deleteTask(this.taskId);
                    
                    // Animation
                    this.$root.classList.add('deleting');
                    setTimeout(() => {
                        this.$root.remove();
                    }, 300);
                    
                    console.log('Task deleted successfully');
                } else {
                    alert('Failed to delete task');
                }
            } catch (error) {
                console.error('Error deleting task:', error);
                alert('Error deleting task');
            }
        }
    };
}