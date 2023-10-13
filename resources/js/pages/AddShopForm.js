import 'ckeditor4'

export default class RegisterForm {

    constructor() {
        if(document.querySelector('body.add_shop, body.update_shop')) {
            this.initEls()
            this.initEvents()
        } else return

        this.config = {
            api_endpoint : 'https://api-adresse.data.gouv.fr/search/?q='
        }
        this.selectedItem = 0
        this.adresses = []
        this.categories = {}
        this.maxPictures = 4
        this.totalPictures = 0
    }


    initEls() {
        const __ = selector => document.querySelector(selector)

        this.els = {
            //autocomplete
            inputAutoComplete : __('.js-adress'),
            autoCompleteContainer : __('.js-autocomplete'),
            inputCity : __('.js-city'),
            inputCp : __('.js-cp'),
            inputStreetNumber : __('.js-street_number'),
            inputLat : __('.js-lat'),
            inputLng : __('.js-lng'),
            inputInsee : __('.js-citycode'),
            autoCompleteItems : 0,
            inputPicture: __('.js-input-picture'),
            pictureRows : document.querySelectorAll('tr[data-picture], .js-picture-row'),
            //selects category
            selectCategory : __('.js-category'),
            selectSubCategory : __('.js-subcategory'),
        }
    }

    initEvents() {
        CKEDITOR.replace( 'summary-ckeditor', {
            toolbarGroups : [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                '/',
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ],
            removeButtons : 'Source,Save,Templates,NewPage,ExportPdf,Preview,Print,Cut,Copy,Paste,PasteText,PasteFromWord,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,CreateDiv,Anchor,Image,Flash,Smiley,PageBreak,Iframe,Styles,Font,Format,FontSize,BGColor,ShowBlocks,BidiLtr,BidiRtl,Language,Subscript,Superscript,TextColor,Replace,Find,Indent,Outdent'
        });
        const editor = document.querySelector('#summary-ckeditor').getAttribute('data-content')
        editor && CKEDITOR.instances['summary-ckeditor'].setData(editor)

        this.initAutoComplete()
        this.initSelects()
        this.initDeletePictures()
        this.initPictureChange()
        this.countPictures()
    }

    initAutoComplete() {
        this.els.inputAutoComplete.addEventListener('input', () =>  {
            this._autoComplete().catch(e => console.log(e))
        })
        this.els.inputAutoComplete.addEventListener('blur', (e) =>  {
            this.els.autoCompleteContainer.classList.add('js-hidden')
        })
        this.els.inputAutoComplete.addEventListener('focus', (e) =>  {
            this.els.autoCompleteContainer.classList.add('js-hidden')
        })
        this.els.inputAutoComplete.addEventListener('keydown', event => {
            this._keyboardNavigation(event)
        })
    }

    _keyboardNavigation(event) {
        if (this.els.autoCompleteItems.length === 0) return
        if(event.key === 'ArrowDown' && this.selectedItem < this.els.autoCompleteItems.length) {
            this.selectedItem++
        }
        else if (event.key === 'ArrowUp' && this.selectedItem > 0) {
            this.selectedItem--
        }
        if (event.key === 'Enter' && this.selectedItem > 0) {
            event.preventDefault()
            this._handleView(false)
            this._fillForm(this.selectedItem - 1)
            this.selectedItem = 0
        }
        try {
            document.querySelectorAll(`ul.js-autocomplete li`).forEach((item, i) => {
                if (i === this.selectedItem - 1) item.classList.add('js-active')
                else item.classList.remove('js-active')
            })
        } catch (e) {}
    }

    _listenKeyEvents(event) {
        if(event.key === 'ArrowDown' && this.selectedItem < this.els.autoCompleteItems.length) {
            this.selectedItem++
        }
        else if (event.key === 'ArrowUp' && this.selectedItem > 0) {
            this.selectedItem--
        }
    }

    async _autoComplete() {
        const value = this.els.inputAutoComplete.value

        if(!value) {
            this._handleView(false)
            return
        }

        this.els.autoCompleteContainer.classList.remove('js-hidden')
        const query = value.split(' ').join('+')

        const source = await fetch(this.config.api_endpoint + query)
        const res = await source.json()
        this.adresses = res

        if (res.features.length === 0) this._handleView('false')
        const formatted_res = res.features.map(adress => adress.properties.label)

        this._createList(formatted_res)
    }

    _createList(data) {
        if(data.length === 0) this._handleView()
        this.els.autoCompleteContainer.innerHTML = ''
        data.forEach((result, count) => {
            this._createListItem(result, count)
        })
        this.els.autoCompleteItems = this.els.autoCompleteContainer.querySelectorAll('li')
        this._handleView(true)
    }

    _createListItem(result, count) {
        const li = document.createElement('li')
        li.addEventListener('mousedown', e => {
            this.els.autoCompleteContainer.classList.add('js-hidden')
            if(this.els.autoCompleteItems) {
                this._fillForm(count)
            }
        })
        li.textContent = result
        this.els.autoCompleteContainer.appendChild(li)
    }

    _fillForm(count) {
        const properties = this.adresses.features[count].properties
        const [lng, lat] = this.adresses.features[count].geometry.coordinates

        if (properties.type !== "municipality") {
            this.els.inputAutoComplete.value = properties.street || properties.name
            if(properties.type === 'housenumber') {
                this.els.inputStreetNumber.value = properties.housenumber
            } else {
                this.els.inputStreetNumber.value = ''
            }
            this.els.inputCp.value     = properties.postcode
            this.els.inputCity.value   = properties.city
            this.els.inputLat.value    = lat
            this.els.inputLng.value    = lng
            this.els.inputInsee.value  = properties.citycode
        } else {
            this.els.inputCity.value         = ''
            this.els.inputCp.value           = ''
            this.els.inputStreetNumber.value = ''
            this.els.inputLat.value          = ''
            this.els.inputLng.value          = ''
            this.els.inputLng.value          = ''
            this.els.inputInsee.value        = ''
        }
    }

    _handleView(haveResult = false) {
        if (!haveResult) this.els.autoCompleteContainer.classList.add('js-hidden')
        else this.els.autoCompleteContainer.classList.remove('js-hidden')
    }

    async initSelects() {
        this._listenSelects()
        const url = `${window.location.origin}/API/get-categories-list`
        try {
            const request = await fetch(url)
            this.categories = await request.json()
        } catch(e) {
            console.log(e)
        }
        // this.categories.forEach((category, i) => {
        //     this._fillSubCategory(category.subcategories)
        // })
    }

    _fillSubCategory(list) {
        this.els.selectSubCategory.innerHTML = ''
        const option = document.createElement('option')
        option.textContent = '--Optionel--'
        option.value = -1
        this.els.selectSubCategory.appendChild(option)
        list.forEach((el) => {
            const option = document.createElement('option')
            option.value = el.id
            option.textContent = el.libelle
            this.els.selectSubCategory.appendChild(option)
        })
    }

    _listenSelects() {
        this.els.selectCategory.addEventListener('change', (e) => {
            const index = this.els.selectCategory.selectedIndex
            this._fillSubCategory(this.categories[index].subcategories)
        })
    }

    initPictureChange() {
        this.els.inputPicture.addEventListener('change', () => {
            this.handleMaxFiles()
        })
    }

    handleMaxFiles() {
        let display
        if(this.countPictures() > this.maxPictures) {
            display = 'block'
        } else {
            display = 'none'
        }
        document.querySelector('.js-max-pictures').style.display = display
    }

    countPictures() {
        this.totalPictures =
            document.querySelectorAll('tr[data-picture]').length
            +
            this.els.inputPicture.files.length
        return this.totalPictures
    }

    initDeletePictures() {
        this.els.pictureRows.forEach((el) => {
            const button = el.querySelector('button')
            button.addEventListener('click', async (e) => {
                e.preventDefault()
                const id = button.getAttribute('data-picture')
                const url = `${window.location.origin}/API/delete-picture/${id}`
                const request = await fetch(url)
                const response = await request.json()
                if (response.status === 200) {
                    document.querySelector(`tr[data-picture="${id}"]`).remove()
                }
                this.handleMaxFiles()
            })
        })
    }
}
