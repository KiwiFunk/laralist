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
    
    // Store will be initialized in the Blade template with server data
});

window.Alpine = Alpine
 
Alpine.start()