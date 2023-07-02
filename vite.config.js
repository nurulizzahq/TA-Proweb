import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/ui.css",
                "resources/js/app.js",
                "resources/scss/unreset.scss",
                "resources/js/welcome.js",
                "resources/js/universal.js",
                "resources/js/assignment.js",
                "resources/js/modal.js",
            ],
            refresh: true,
        }),
    ],
});
