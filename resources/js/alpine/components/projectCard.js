export function projectCard(projectId) {
    return {
        loading: false,
        projectId: projectId,

        // Get data from Alpine store using projectId
        get project() {
            return this.$store.taskManager.projects.find(p => p.id === this.projectId);
        },
    }
}