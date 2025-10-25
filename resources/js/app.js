import './bootstrap';
// resources/js/app.js
import './maps.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

console.log('Alpine', window.Alpine);

/* -------------------------
   NAV: ajoute des garde-fous
-------------------------- */
const burger = document.querySelector('.burger');
const linksContainer = document.querySelector('.links');
const gear = document.querySelector('.gear');
const subMenuBlock = document.querySelector('.sous-menu-block');
const disciplineLinks = document.querySelectorAll('header.pc .discipline a');

if (disciplineLinks && disciplineLinks.length) {
    disciplineLinks.forEach(a => {
        a.addEventListener('click', () => {
            disciplineLinks.forEach(x => x.classList.remove('active'));
            a.classList.add('active');
        });
    });
}

if (burger && linksContainer) {
    burger.addEventListener('click', (event) => {
        burger.classList.toggle('active');
        linksContainer.classList.toggle('active');
        event.stopPropagation();
    });

    document.querySelectorAll('.nav-link').forEach(n => n.addEventListener('click', () => {
        burger.classList.remove('active');
        linksContainer.classList.remove('active');
    }));

    document.addEventListener('click', (event) => {
        if (!burger.contains(event.target) && !linksContainer.contains(event.target)) {
            burger.classList.remove('active');
            linksContainer.classList.remove('active');
        }
    });
}

if (gear && subMenuBlock) {
    gear.addEventListener('click', (event) => {
        gear.classList.toggle('active');
        subMenuBlock.classList.toggle('active');
        event.stopPropagation();
    });

    document.addEventListener('click', (event) => {
        if (!gear.contains(event.target) && !subMenuBlock.contains(event.target)) {
            gear.classList.remove('active');
            subMenuBlock.classList.remove('active');
        }
    });
}

/* -------------------------------------------------------
   CKEDITOR côté front (OPTIONNEL)
   - Ne fait rien s’il n’y a pas #editor
   - Ne touche pas à l’admin (tu as déjà Ck5Decoupled)
   - Aucune licenseKey, aucun plugin premium
-------------------------------------------------------- */
(function initFrontCK() {
    const el = document.querySelector('#editor');
    if (!el) return; // aucune zone d’édition sur cette page

    if (!window.CKEDITOR || !window.CKEDITOR.ClassicEditor) {
        console.warn('[CKEditor] UMD non chargé sur cette page — init ignorée.');
        return;
    }

    const {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Link,
        BlockQuote,
        Heading,
        Indent,
        IndentBlock,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        Underline,
        Autosave,
        BalloonToolbar,
        List
    } = window.CKEDITOR;

    ClassicEditor.create(el, {
        language: 'fr',
        // uniquement des plugins “free”
        plugins: [
            Essentials, Paragraph, Bold, Italic, Underline, Link,
            Heading, Indent, IndentBlock, BlockQuote,
            Table, TableCaption, TableCellProperties, TableColumnResize, TableProperties, TableToolbar,
            Autosave, BalloonToolbar, List
        ],
        toolbar: [
            'undo', 'redo', '|',
            'heading', '|',
            'bold', 'italic', 'underline', '|',
            'link', 'insertTable', 'blockQuote', '|',
            'bulletedList', 'numberedList', 'outdent', 'indent'
        ],
        balloonToolbar: ['bold', 'italic', '|', 'link'],
        // ⚠️ surtout PAS de `licenseKey` ici
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            decorators: {
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: { download: 'file' }
                }
            }
        },
        placeholder: 'Type or paste your content here!',
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
        }
    }).catch(console.error);
})();
