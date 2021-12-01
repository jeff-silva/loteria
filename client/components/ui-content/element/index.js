const context = require.context('./', true);
let elements = [];

context.keys().forEach(key => {
    if (! /info.js/.test(key)) return;
    let folder = key.split('/')[1];
    let editor = context(`./${folder}/editor`).default;
    let render = context(`./${folder}/render`).default;
    let info = context(`./${folder}/info`).default;

    let element = {
        element: `ui-content-element-${folder}-render`,
        name: folder,
        description: `${folder} component`,
        bind: {},
        editor, render,
        ...info
    };

    element.bind = {
        style: {},
        ...element.bind
    };

    element.bind.style = {
        'margin-top': '0px',
        'margin-right': '0px',
        'margin-bottom': '0px',
        'margin-left': '0px',
        'padding-top': '0px',
        'padding-right': '0px',
        'padding-bottom': '0px',
        'padding-left': '0px',
        ...element.bind.style
    };

    elements.push(element);
});

export default elements;