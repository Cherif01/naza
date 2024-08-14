<div class="m-5 p-5"></div>
<!-- <hr> -->
<!-- <footer class="fixed-bottom position-relative">
    <div class="footer clearfix mb-0 text-muted text-center">
        <div class="float-start">
            <p><?= date("Y") ?> &copy; S.P.A</p>
        </div>
        <div class="float-end">
            <p>Created <span class="text-danger"><i class="bi bi-heart"></i></span> BY : <a target="_blank" href="https://www.spa-dev.com">S.P.A - TECHNOLGY</a></p>
        </div>
    </div>
</footer> -->
</div>
</div>
<script src="<?= LINK ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= LINK ?>assets/js/bootstrap.bundle.min.js"></script>

<script src="<?= LINK ?>assets/vendors/apexcharts/apexcharts.js"></script>
<script src="<?= LINK ?>assets/js/pages/dashboard.js"></script>

<script src="<?= LINK ?>assets/js/main.js"></script>
<script src="<?= LINK ?>/assets/script.js"></script>

<script src="<?= LINK ?>assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let maTable = document.querySelector('#maTable');
    let dataTable = new simpleDatatables.DataTable(maTable);
</script>

<script src="<?= LINK ?>assets/script.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // toastr.success('Message de succès avec une barre de progression et une icône!');
    // toastr.error('Error')
</script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const successMessage = urlParams.get('success');
    const errorMessage = urlParams.get('error');
    if (successMessage) {
        toastr.success(successMessage);
    }
    if (errorMessage) {
        toastr.error(errorMessage);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.22/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>



<script>
    let montantForm = document.getElementById('form-montant');
    let mt_ = document.getElementById('_mt');

    montantForm.addEventListener('input', e => {
        var input = e.target.value;

        // Supprime tous les caractères sauf les chiffres et les virgules
        input = input.replace(/[^0-9,]/g, '');

        // Remplace toutes les virgules par des points pour manipulation numérique
        var numericInput = input.replace(/,/g, '.');

        // Convertit en nombre flottant
        var floatValue = parseFloat(numericInput);

        // Si le nombre est valide
        if (!isNaN(floatValue)) {
            // Formate le nombre avec séparateurs de milliers et deux décimales
            var formattedValue = floatValue.toLocaleString('fr-FR');

            // Remplace le point décimal par une virgule
            formattedValue = formattedValue.replace('.', ',');

            e.target.value = formattedValue;
            mt_.value = floatValue;
        } else {
            // Si le nombre n'est pas valide, garde l'entrée d'origine
            e.target.value = input;
        }
    });

    // Si l'envoie se fait en GNF
    function calcReceptionGNF() {
        const montant = parseFloat(document.getElementById('_mt').value)
        const tauxIP = parseFloat(document.getElementById('form-taux').value)

        if (isNaN(montant) || isNaN(tauxIP) || tauxIP === 0) {
            document.getElementById('reception').value =
                'Veuillez entrer des valeurs valides'
            return
        }
        // Calcul du 3%
        let montant3_ = (montant * 3) / 100

        // Conversion du montant
        let montantConverti = (montant - montant3_) / tauxIP

        // Formatage en devise CAD
        let options = {
            style: 'currency',
            currency: 'CAD'
        }
        document.getElementById('reception').value =
            montantConverti.toLocaleString('en-CA', options)
    }

    // Si l'envoie est depuis le CAD
    function calcReceptionCAD() {
        let Montant = document.getElementById('_mt').value
        let tauxIP = document.getElementById('form-taux').value
        let reception = document.getElementById('reception')

        let montantConverti = parseFloat(Montant * tauxIP)

        let options = {
            style: 'currency',
            currency: 'GNF'
        }
        reception.value = montantConverti.toLocaleString('en-CA', options)
    }


    function deleteAlert(id, url) {
        Swal.fire({
            title: "Êtes-vous sûr ?",
            text: "Supprimer définitivement la ligne !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Oui, je supprime !"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Supprimé !",
                    text: "L'élément a été supprimé avec succès.",
                    icon: "success"
                }).then(() => {
                    // Rediriger vers l'URL pour actualiser la page ou effectuer la suppression
                    window.location.href = url + id;
                });
            }
        });
    }

    // function generateReceipt() {
    //     const montant = document.getElementById('form-montant').value
    //     const taux = document.getElementById('form-taux').value
    //     const agence =
    //         document.querySelector('select[name="_idAgence"]')?.selectedOptions[0]
    //         ?.text || ''
    //     const reception = document.getElementById('reception').innerText
    //     const prenomExp = document.getElementById('prenomExp').value
    //     const nomExp = document.getElementById('nomExp').value
    //     const telephoneExp = document.getElementById('telExp').value
    //     const prenomBenef = document.getElementById('prenomBenef').value
    //     const nomBenef = document.getElementById('NomBenef').value
    //     const telephoneBenef = document.getElementById('numberBenef').value

    //     document.getElementById('montant_').innerText = montant
    //     document.getElementById('taux_').innerText = taux
    //     document.getElementById('agence_').innerText = agence
    //     document.getElementById('reception_').innerText = reception
    //     document.getElementById('prenomExp_').innerText = prenomExp
    //     document.getElementById('nomExp_').innerText = nomExp
    //     document.getElementById('telephoneExp_').innerText = telephoneExp
    //     document.getElementById('prenomBenef_').innerText = prenomBenef
    //     document.getElementById('nomBenef_').innerText = nomBenef
    //     document.getElementById('telephoneBenef_').innerText = telephoneBenef
    // }
</script>