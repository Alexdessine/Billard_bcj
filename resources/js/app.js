import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log("Alpine", window.Alpine);

const burger = document.querySelector(".burger");
const link = document.querySelector(".links");
const sous_menu = document.querySelector(".gear");
const sous_menu_block = document.querySelector(".sous-menu-block");
const disciplineLinks = document.querySelectorAll("header.pc .discipline a");

// Ajoute un gestionnaire d'événements pour chaque lien
disciplineLinks.forEach(link => {
    link.addEventListener("click", (e) => {
        disciplineLinks.forEach(link => link.classList.remove("active"));
        link.classList.add("active");
    });
});

// Ouvre/Ferme le menu mobile au clic sur le burger
burger.addEventListener("click", (event) => {
    burger.classList.toggle("active");
    link.classList.toggle("active");
    event.stopPropagation(); // Empêche la propagation du clic pour éviter la fermeture immédiate
});

// Ferme le menu mobile au clic sur un lien
document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
    burger.classList.remove("active");
    link.classList.remove("active");
}));

// Ferme le menu mobile en cliquant en dehors
document.addEventListener("click", (event) => {
    if (!burger.contains(event.target) && !link.contains(event.target)) {
        burger.classList.remove("active");
        link.classList.remove("active");
    }
});

// Gestion du sous-menu
sous_menu.addEventListener("click", (event) => {
    sous_menu.classList.toggle("active");
    sous_menu_block.classList.toggle("active");
    event.stopPropagation(); // Empêche la fermeture immédiate du sous-menu
});

// Ferme le sous-menu en cliquant en dehors
document.addEventListener("click", (event) => {
    if (!sous_menu.contains(event.target) && !sous_menu_block.contains(event.target)) {
        sous_menu.classList.remove("active");
        sous_menu_block.classList.remove("active");
    }
});

const {
    ClassicEditor,
    Autosave,
    BalloonToolbar,
    BlockQuote,
    Bold,
    Essentials,
    Heading,
    Indent,
    IndentBlock,
    Italic,
    Link,
    Paragraph,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    Underline
} = window.CKEDITOR;

const LICENSE_KEY =
    'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NDY5MjE1OTksImp0aSI6IjNiMjU2ZTI0LTJiZjAtNDcyOS05ZDQzLTEwMWIyMzVkY2Q1NyIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImY0OWQwMDk3In0.-VzicXsPNiciEBpWPkfmgViZ067_iRguyh3KX081agy4t1zZmFVvIe5YYBX7XOqZ75342mTt59GQQ__7wuHzbQ';

const editorConfig = {
    toolbar: {
        items: ['heading', '|', 'bold', 'italic', 'underline', '|', 'link', 'insertTable', 'blockQuote', '|', 'outdent', 'indent'],
        shouldNotGroupWhenFull: false
    },
    plugins: [
        Autosave,
        BalloonToolbar,
        BlockQuote,
        Bold,
        Essentials,
        Heading,
        Indent,
        IndentBlock,
        Italic,
        Link,
        Paragraph,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        Underline
    ],
    balloonToolbar: ['bold', 'italic', '|', 'link'],
    heading: {
        options: [
            {
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
            },
            {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
            },
            {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
            },
            {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
            },
            {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
            },
            {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
            },
            {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
            }
        ]
    },
    initialData:
        '<h2>Congratulations on setting up CKEditor 5! 🎉</h2>\n<p>\n\tYou\'ve successfully created a CKEditor 5 project. This powerful text editor\n\twill enhance your application, enabling rich text editing capabilities that\n\tare customizable and easy to use.\n</p>\n<h3>What\'s next?</h3>\n<ol>\n\t<li>\n\t\t<strong>Integrate into your app</strong>: time to bring the editing into\n\t\tyour application. Take the code you created and add to your application.\n\t</li>\n\t<li>\n\t\t<strong>Explore features:</strong> Experiment with different plugins and\n\t\ttoolbar options to discover what works best for your needs.\n\t</li>\n\t<li>\n\t\t<strong>Customize your editor:</strong> Tailor the editor\'s\n\t\tconfiguration to match your application\'s style and requirements. Or\n\t\teven write your plugin!\n\t</li>\n</ol>\n<p>\n\tKeep experimenting, and don\'t hesitate to push the boundaries of what you\n\tcan achieve with CKEditor 5. Your feedback is invaluable to us as we strive\n\tto improve and evolve. Happy editing!\n</p>\n<h3>Helpful resources</h3>\n<ul>\n\t<li>📝 <a href="https://portal.ckeditor.com/checkout?plan=free">Trial sign up</a>,</li>\n\t<li>📕 <a href="https://ckeditor.com/docs/ckeditor5/latest/installation/index.html">Documentation</a>,</li>\n\t<li>⭐️ <a href="https://github.com/ckeditor/ckeditor5">GitHub</a> (star us if you can!),</li>\n\t<li>🏠 <a href="https://ckeditor.com">CKEditor Homepage</a>,</li>\n\t<li>🧑‍💻 <a href="https://ckeditor.com/ckeditor-5/demo/">CKEditor 5 Demos</a>,</li>\n</ul>\n<h3>Need help?</h3>\n<p>\n\tSee this text, but the editor is not starting up? Check the browser\'s\n\tconsole for clues and guidance. It may be related to an incorrect license\n\tkey if you use premium features or another feature-related requirement. If\n\tyou cannot make it work, file a GitHub issue, and we will help as soon as\n\tpossible!\n</p>\n',
    language: 'fr',
    licenseKey: LICENSE_KEY,
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        decorators: {
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file'
                }
            }
        }
    },
    menuBar: {
        isVisible: true
    },
    placeholder: 'Type or paste your content here!',
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
    }
};

ClassicEditor.create(document.querySelector('#editor'), editorConfig);


