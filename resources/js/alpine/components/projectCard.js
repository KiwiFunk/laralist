export function projectCard(projectId) {
    return {
        loading: false,
        projectId: projectId,
        isDropdownOpen: false,

        // Get data from Alpine store using projectId
        get project() {
            return this.$store.taskManager.projects.find(p => p.id === this.projectId);
        },

        // Delete a project
        async deleteProject() {
            if (!confirm('Are you sure you want to delete this project? This action cannot be undone.')) {
                return;
            }

            try {
                const response = await fetch(`/projects/${this.projectId}`, {
                    method: 'DELETE',
                    // Set AJAX and CSRF headers
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Remove project from store
                    this.$store.taskManager.projects = this.$store.taskManager.projects.filter(
                        p => p.id !== this.projectId
                    );
                    
                    this.$root.classList.add('deleting');
                    setTimeout(() => {
                        this.$root.remove();
                    }, 300);

                    console.log('Project deleted successfully');
                    
                } else {
                    alert('Failed to delete project. Please try again.');
                }

            } catch (error) {
                console.error('Error deleting project:', error);
                alert('Problem deleting project. Please try again.');
            }
        }
    };
}