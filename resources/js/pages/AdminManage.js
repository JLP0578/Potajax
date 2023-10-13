export default class AdminManage {

    constructor() {
        return
        if(!document.querySelector('body.manage_subcategories')) return
        this.initEls()
        this.initEvents()
        this.labelClasses = 'mb-2 form-label text-md-right mr-2'
        this.inputClasses = 'form-control col-md-6'
        this.containerClasses = 'form-group row'
        this.countInputs = document.querySelectorAll('.js-count').length - 1
    }

    initEls() {
        const __ = selector => document.querySelector(selector)
        this.els = {
            addRowButton : __('.js-add-row-button'),
            inputsContainer : __('.js-inputs-container')
        }
    }

    initEvents() {
        this.els.addRowButton.addEventListener('click', (e) => {
            e.preventDefault()
            this.countInputs++
            this.els.inputsContainer.appendChild(this.createRow())
        })
    }

    createRow() {
        const id = `subcategory_${this.countInputs}`
        const container = this.createEl('div', { class: this.containerClasses })
        const label = this.createEl('label', { class: this.labelClasses, for: id}, 'Nom')
        const input = this.createEl('input', {
            class: this.inputClasses,
            type: 'text',
            name: 'subcategories[]',
            id
        })
        container.appendChild(label)
        container.appendChild(input)
        return container
    }

    createEl(element, attributes, text, parentNode) {
        let el = document.createElement(element)
        if (attributes) {
            for(const [key, value] of Object.entries(attributes)) {
                el.setAttribute(key,value)
            }
        }
        if(text) el.appendChild(document.createTextNode(text))
        if(parentNode) parentNode.appendChild(el)
        return el
    }
}
