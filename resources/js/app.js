import './bootstrap';
import Alpine from 'alpinejs'

// Import Modules
import { createTaskStore } from './alpine/store';
import { taskCard } from './alpine/components/taskCard';
import { createTaskForm } from './alpine/components/createTask';

// Register Alpine stores and components
document.addEventListener('alpine:init', () => {

    Alpine.data('taskCard', taskCard);
    Alpine.data('createTaskForm', createTaskForm);
    
    // Init Alpine store with data from meta tag
    const tasksData = JSON.parse(document.querySelector('meta[name="tasks-data"]')?.content || '[]');
    Alpine.store('taskManager', createTaskStore(tasksData));
});

window.Alpine = Alpine
 
Alpine.start()