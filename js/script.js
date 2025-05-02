document.addEventListener("DOMContentLoaded", () => {
    const taskInput = document.querySelector("input[name='task']");
    taskInput.addEventListener("input", () => {
        taskInput.style.background = taskInput.value ? "#e3f2fd" : "white";
    });
});