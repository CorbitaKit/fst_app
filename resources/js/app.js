import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/aura-light-green/theme.css';
import "primeflex/primeflex.css";
import 'primeicons/primeicons.css'
import Tooltip from 'primevue/tooltip';
import { createPinia } from 'pinia';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import FileUpload from 'primevue/fileupload';
import ProgressBar from 'primevue/progressbar';
import TreeTable from 'primevue/treetable';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue)
      .use(createPinia())
      .directive('tooltip', Tooltip)
      .component('Button', Button)
      .component('DataTable', DataTable)
      .component('Column', Column)
      .component('FileUpload', FileUpload)
      .component('ProgressBar', ProgressBar)
      .component('TreeTable', TreeTable)
      .mount(el)
      
  },
})