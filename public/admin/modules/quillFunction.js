let container = document.getElementById('editor');
let options = {
    modules: {

    },
    readOnly: true,
    theme: 'snow'
};
editor = new Quill(container, options);
