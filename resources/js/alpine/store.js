export function createTaskStore(initialTasks) {
    return {
        // Initialize with server data
        tasks: initialTasks,
        
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
}