<main class="container mt-5">
    <h2>Charge incorporelle :</h2>
    <div class="conteneur">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="valeurCharge" class="form-label">Insertion de charge non incorporelle</label>
                        <p>Unite d'oeuvre :</p>
                        <div class="wave-group">
                            <select name="unite" class="input">
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                                <option value="">Option 3</option>
                            </select>
                            <span class="bar"></span>
                        </div>
                        <p>Nature :</p>
                        <div class="wave-group">
                            <select name="nature" class="input">
                                <option value="Fixe">Fixe</option>
                                <option value="Variable">Variable</option>
                            </select>
                            <span class="bar"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-warning btn-lg">Valider</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Le div où le contenu sera chargé dynamiquement -->
            <div class="col-md-6" id="dynamicView">
                <img src="assets/img/YaourtBon.jpg" class="img-fluid rounded" alt="Image yaourt">
            </div>
        </div>
    </div>
</main>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    // Surveille le changement de l'option du <select>
    $('select[name="nature"]').on('change', function () {
      let selectedValue = $(this).val(); // Récupère la valeur sélectionnée
      
      // Effectue une requête AJAX en fonction de la sélection
      $.ajax({
        url: selectedValue === 'Fixe' ? 'ChargeIncorporelle/incorporelle_fixe' : 'ChargeIncorporelle/incorporelle_variable', // URL du contrôleur en fonction de la sélection
        type: 'GET',
        success: function (response) {
          // Charge le contenu dans le div avec l'id "dynamicView"
          $('#dynamicView').html(response);
        },
        error: function () {
          alert('Erreur lors du chargement de la vue');
        }
      });
    });
  });
</script>
