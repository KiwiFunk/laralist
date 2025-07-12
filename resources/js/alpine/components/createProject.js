export function createProjectForm() {
    return {
        loading: false,

        async createProject(event) {
            this.loading = true;
            try {
                const form = event.target;
                const formData = new FormData(form);

                const response = await fetch('/projects', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    //add form data to global store
                    //Call refresh function ((FOR NOW))
                    this.addProjectToDOM(data.project);
                } else {
                    alert('Failed to create project');
                }
            } catch (error) {
                console.error('Error creating project:', error);
                alert('Error creating project');
            } finally {
                this.loading = false;
            }
        },

        addProjectToDOM(project) {
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }
    };
}