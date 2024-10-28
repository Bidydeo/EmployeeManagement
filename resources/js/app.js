import "./bootstrap";
import { createApp } from "vue";
import ChatComponent from "./components/ChatComponent.vue";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
const app = createApp({});

app.component("chat-component", ChatComponent);
app.mount("#app");
