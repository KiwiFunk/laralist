import './bootstrap';
import Alpine from 'alpinejs'

// Import Modules
import { createTaskStore } from './alpine/store';
import { taskCard } from './alpine/components/taskCard';
import { createTaskForm } from './alpine/components/createTask';
import { createProjectForm } from './alpine/components/createProject';

// Ensure Alpine.js is available globally
window.Alpine = Alpine  

// Register Alpine stores and components
document.addEventListener('alpine:init', () => {
    console.log('Alpine initializing...');

    Alpine.data('taskCard', taskCard);
    Alpine.data('createTaskForm', createTaskForm);
    Alpine.data('createProjectForm', createProjectForm);
    
    // Init Alpine store with data from meta tag
    const tasksData = JSON.parse(document.querySelector('meta[name="tasks-data"]')?.content || '[]');
    Alpine.store('taskManager', createTaskStore(tasksData));

    console.log('Alpine components registered');
});

// Debug Alpine startup
Alpine.start().then(() => {
    console.log('Alpine started successfully');
}).catch(error => {
    console.error('Alpine failed to start:', error);
});