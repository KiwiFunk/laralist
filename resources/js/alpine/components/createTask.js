export function createTaskForm() {
    return {
        loading: false,
         
        async createTask(event) {
            this.loading = true;
            try {
                const form = event.target;
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
                    this.$store.taskManager.addTask(data.task);
                    form.reset();
                    this.addTaskToDOM(data.task);
                    console.log('Task created successfully:', data.task);
                } else {
                    alert('Failed to create task');
                }
            } catch (error) {
                console.error('Error creating task:', error);
                alert('Error creating task');
            } finally {
                this.loading = false;
            }
        },
         
        addTaskToDOM(task) {
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }
    };
}