export function createTaskStore(initialTasks, project = null) {
    return {
        // Initialize with server data
        tasks: initialTasks,
        project: project,
        
        // Computed stats (automatically reactive)
        get stats() {
            return {
                total: this.tasks.length,
                completed: this.tasks.filter(task => task.completed).length,
                pending: this.tasks.filter(task => !task.completed).length
            };
        },
        
        // Actions to modify tasks
        updateTask(taskId, updatedTask) {
            const index = this.tasks.findIndex(t => t.id === taskId);
            if (index !== -1) {
                this.tasks[index] = { ...this.tasks[index], ...updatedTask };
            }
        },
        
        toggleTask(taskId) {
            const task = this.tasks.find(t => t.id === taskId);
            if (task) {
                task.completed = !task.completed;
            }
        },
        
        deleteTask(taskId) {
            this.tasks = this.tasks.filter(t => t.id !== taskId);
        },
        
        addTask(newTask) {
            this.tasks.push(newTask);
        }
    };
};

export function createProjectStore(initialProjects) {
    return {
        // Initialize with server JSON data
        projects: initialProjects,
        
        // Actions to modify projects
        updateProject(projectId, updatedProject) {
            const index = this.projects.findIndex(p => p.id === projectId);
            if (index !== -1) {
                this.projects[index] = { ...this.projects[index], ...updatedProject };
            }
        },
        
        toggleProject(projectId) {
            const project = this.projects.find(p => p.id === projectId);
            if (project) {
                project.active = !project.active;
            }
        },
        
        deleteProject(projectId) {
            this.projects = this.projects.filter(p => p.id !== projectId);
        },
        
        addProject(newProject) {
            this.projects.push(newProject);
        }
    };
}