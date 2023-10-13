export default class ReviewForm {
    constructor() {
        if(document.querySelector('body.shop')) {
            this.initEls()
            this.initEvents()
            this.updateFormIsOpen = false
            this.addFormIsOpen = false
        } else return
    }

    initEls() {
        const __ = selector => document.querySelector(selector)
        this.els = {
            updateReviewForm : __('.js-update-review-form'),
            updateReviewButton : __('.js-update-review-button'),
            addReviewButton: __('.js-add-review-button'),
            addReviewForm: __('.js-add-review-form')
        }
    }

    initEvents() {
        if(this.els.updateReviewButton) {
            this.els.updateReviewButton.addEventListener('click', () => this.toggleUpdateForm())
        }

        if(this.els.addReviewButton) {
            this.els.addReviewButton.addEventListener('click', () => this.toggleAddForm())
        }
    }

    toggleAddForm() {
        if(this.addFormIsOpen) {
            this.els.addReviewForm.classList.remove('active');
            this.els.addReviewButton.textContent = 'Ajouter un avis'
            this.addFormIsOpen = false
        } else {
            this.els.addReviewForm.classList.add('active');
            this.els.addReviewButton.textContent = 'Fermer'
            this.addFormIsOpen = true
        }
    }

    toggleUpdateForm() {
        if(this.updateFormIsOpen) {
            this.els.updateReviewForm.style.height = 0
            this.updateFormIsOpen = false
        } else {
            this.els.updateReviewForm.style.height = 'auto'
            this.updateFormIsOpen = true
        }
    }
}
