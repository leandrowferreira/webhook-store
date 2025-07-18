
import './bootstrap';
import 'bootstrap';
import 'json-viewer-component/dist/index.js';


document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('json-viewer');
    if (!container || !window.webhookBody) return;

    const viewer = document.createElement('json-viewer');
    viewer.textContent = JSON.stringify(JSON.parse(window.webhookBody));
    viewer.setAttribute('counter', 'true');
    container.appendChild(viewer);
});