(function () {
    const textarea = document.getElementById('html_content');
    const templateSelect = document.getElementById('template');
    if (!textarea || !templateSelect || !window.ClassicEditor) return;

    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const templates = window.STUDY_TEMPLATES || {};

    let editorInstance = null;
    let originalTemplate = templateSelect.value;

    ClassicEditor
        .create(textarea, {
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
        })
        .then(editor => {
            editorInstance = editor;
        })
        .catch(err => console.error(err));

    templateSelect.addEventListener('change', function () {
        if (!editorInstance) return;
        const next = templateSelect.value;
        const current = editorInstance.getData();

        if (current && current.trim() !== (templates[originalTemplate] || '').trim()) {
            if (!confirm('Switching template will replace your current content. Continue?')) {
                templateSelect.value = originalTemplate;
                return;
            }
        }

        editorInstance.setData(templates[next] || '');
        originalTemplate = next;
    });
})();
