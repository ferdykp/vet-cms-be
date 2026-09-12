import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.cmsShell = () => ({
    mobileNav: false,
    closeMobileNav() { this.mobileNav = false; },
});

window.postEditor = (initial = [], initialStatus = 'draft') => ({
    blocks: Array.isArray(initial)
        ? initial.map((block, index) => ({
            uid: crypto.randomUUID?.() || `${Date.now()}-${index}`,
            type: block.type || 'paragraph',
            data: block.data || { text: '' },
        }))
        : [],
    status: initialStatus || 'draft',
    settingsOpen: true,
    tab: 'document',
    commandOpen: false,
    previewMode: false,
    dirty: false,
    submitted: false,

    init() {
        if (!this.blocks.length) this.addBlock('paragraph', false);
        const form = this.$root;
        form.addEventListener('input', () => { this.dirty = true; });
        form.addEventListener('change', () => { this.dirty = true; });
        form.addEventListener('submit', () => {
            this.serialize();
            this.submitted = true;
        });
        window.addEventListener('beforeunload', (event) => {
            if (!this.dirty || this.submitted) return;
            event.preventDefault();
            event.returnValue = '';
        });
    },

    addBlock(type, markDirty = true) {
        const data = { text: '' };
        if (type === 'callout') data.title = 'Clinical note';
        if (type === 'image') Object.assign(data, { url: '', caption: '', alt: '' });
        this.blocks.push({
            uid: crypto.randomUUID?.() || `${Date.now()}-${Math.random()}`,
            type,
            data,
        });
        if (markDirty) this.dirty = true;
        this.$nextTick(() => {
            const nodes = this.$root.querySelectorAll('[data-editor-block] textarea, [data-editor-block] input');
            nodes[nodes.length - 1]?.focus();
        });
    },

    removeBlock(index) {
        if (this.blocks.length === 1) {
            this.blocks[0] = { uid: this.blocks[0].uid, type: 'paragraph', data: { text: '' } };
        } else {
            this.blocks.splice(index, 1);
        }
        this.dirty = true;
    },

    moveBlock(index, direction) {
        const next = index + direction;
        if (next < 0 || next >= this.blocks.length) return;
        [this.blocks[index], this.blocks[next]] = [this.blocks[next], this.blocks[index]];
        this.dirty = true;
    },

    serialize() {
        const box = this.$root.querySelector('#serialized-content');
        if (!box) return;
        box.innerHTML = '';
        this.blocks.forEach((block, index) => {
            const type = document.createElement('input');
            type.type = 'hidden';
            type.name = `content[blocks][${index}][type]`;
            type.value = block.type;
            box.appendChild(type);

            Object.entries(block.data || {}).forEach(([key, value]) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `content[blocks][${index}][data][${key}]`;
                input.value = value ?? '';
                box.appendChild(input);
            });
        });
    },

    get saveLabel() {
        return this.dirty ? 'Unsaved changes' : 'All changes saved';
    },

    previewText(value) {
        return String(value || '').trim();
    },
});

window.mediaInspector = () => ({
    selected: null,
    select(value) { this.selected = value; },
    formatSize(value) {
        if (!value) return '—';
        if (value < 1024 * 1024) return `${(value / 1024).toFixed(1)} KB`;
        return `${(value / 1024 / 1024).toFixed(1)} MB`;
    },
});

Alpine.start();
