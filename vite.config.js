import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(), // Pindahkan ke atas jika perlu
        laravel(["resources/css/app.css", "resources/js/app.js"]),
    ],
});
