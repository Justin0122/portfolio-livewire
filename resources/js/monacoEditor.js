import * as monaco from 'monaco-editor';

const editor = monaco.editor.create(document.getElementById('container'), {
    value: "",
    language: "plaintext",
    theme: 'vs-dark',
    automaticLayout: true,
    minimap: {
        enabled: true,
    },
    scrollBeyondLastLine: false,
    wordWrap: 'on',
    wordWrapColumn: 80,
    wrappingIndent: 'indent',
    lineNumbers: 'on',
});


const languageMap = {
    js: 'javascript',
    py: 'python',
    sh: 'shell',
    php: 'php',
}

function replaceEditorContents(text, extension) {
    console.log("replaceEditorContents")
    editor.executeEdits("", [
        {
            range: editor.getModel().getFullModelRange(),
            text: decodeURIComponent(text)
        }
    ]);

    editor.setSelection(new monaco.Selection(0, 0, 0, 0));
    editor.focus();

    const language = languageMap[extension] || "plaintext"
    console.log("setting language to " + language)
    monaco.editor.setModelLanguage(editor.getModel(), language);
}

window.replaceEditorContents = replaceEditorContents
editor.onDidChangeModelContent(function (e) {
    console.log("onDidChangeModelContent")
    const content = editor.getValue();
    const encodedContent = encodeURIComponent(content);
    const input = document.getElementById('snippetContent');
    if (!input) {
        console.error("input not found")
        return
    }
    input.value = encodedContent;
    const event = new Event('input', {bubbles: true});
    input.dispatchEvent(event);

    const checkmark = document.getElementsByClassName('checkmark')[0];
    checkmark.style.color = 'red';
});
