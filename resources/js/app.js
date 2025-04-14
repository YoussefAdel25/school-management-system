import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import { Livewire } from "livewire";
Livewire.start();

const app = createApp({});
app.component('example-component', ExampleComponent);
app.mount('#app');
