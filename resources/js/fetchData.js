export default class fetchData
{

    constructor()
    {
        if(document.querySelector('body.fav'))
        {
            this.init();
        }
    }

    init()
    {
        this.domain_url = window.location.origin;

        let url = this.domain_url+'/favorites';
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let recupId = localStorage.getItem("id");
        let stringId = JSON.stringify(recupId);

        // Fetch si y'a 0 fav dans la page

        // doc.querySelector sur les li de la liste des fav

        let li = document.querySelector('.list-group-item');

        alert(li);

        // fetch(url, {
        //             headers: {
        //                 "Content-Type": "application/json",
        //                 "Accept": "application/json",
        //                 "X-Requested-With": "XMLHttpRequest",
        //                 "X-CSRF-Token": token
        //             },
        //             method: "post",
        //             credentials: "same-origin",
        //             body: stringId
        //         }).then(response => response.text()).catch(error => alert("Erreur : " + error)).then(response => console.log(response));
    }
}
