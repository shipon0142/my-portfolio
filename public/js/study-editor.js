(function () {
    const enTextarea = document.getElementById('html_content');
    const bnTextarea = document.getElementById('html_content_bn');
    const templateSelect = document.getElementById('template');
    if (!enTextarea || !templateSelect || !window.ClassicEditor) return;

    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const templates = window.STUDY_TEMPLATES || {};

    const toolbarConfig = {
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', 'strikethrough', 'code', '|',
            'link', 'bulletedList', 'numberedList', 'blockQuote', 'codeBlock', 'insertTable', '|',
            'imageUpload', '|',
            'undo', 'redo', '|',
            'sourceEditing'
        ],
        simpleUpload: {
            uploadUrl: '/admin/study/uploads',
            headers: { 'X-CSRF-TOKEN': csrf }
        }
    };

    let enEditor = null;
    let bnEditor = null;
    let originalTemplate = templateSelect.value;

    ClassicEditor.create(enTextarea, toolbarConfig)
        .then(editor => { enEditor = editor; })
        .catch(err => console.error(err));

    if (bnTextarea) {
        ClassicEditor.create(bnTextarea, toolbarConfig)
            .then(editor => { bnEditor = editor; })
            .catch(err => console.error(err));
    }

    templateSelect.addEventListener('change', function () {
        if (!enEditor) return;
        const next = templateSelect.value;
        const current = enEditor.getData();

        if (current && current.trim() !== (templates[originalTemplate] || '').trim()) {
            if (!confirm('Switching template will replace your current content (both languages). Continue?')) {
                templateSelect.value = originalTemplate;
                return;
            }
        }

        enEditor.setData(templates[next] || '');
        if (bnEditor) {
            bnEditor.setData(templates[next] || '');
        }
        originalTemplate = next;
    });
})();
