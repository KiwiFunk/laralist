export function taskCard(taskId) {
    return {
        isEditing: false,
        loading: false,
        taskId: taskId,

        // Get data from Alpine store using taskId
        get task() {
            return this.$store.taskManager.tasks.find(t => t.id === this.taskId);
        },

        // Update the Task
        async updateTask() {
            this.loading = true;
            try {
                const form = this.$refs.editForm;
                const formData = new FormData(form);

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
                    this.isEditing = false;
                    this.$store.taskManager.updateTask(data.task.id, data.task);
                    console.log('Task updated successfully:', data.task);
                } else {
                    alert('Oops! Something went wrong while updating the task.');
                }
            } catch (error) {
                console.error('Error updating task:', error);
                alert('An error occurred while updating the task. Please try again.');
            } finally {
                this.loading = false;
            }
        },

        // Toggle Task Status
        async toggleTaskStatus() {
            try {
                const response = await fetch(`/tasks/${this.taskId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.$store.taskManager.toggleTask(this.taskId);
                    console.log(data.message);
                }
            } catch (error) {
                console.error('Error toggling task status:', error);
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