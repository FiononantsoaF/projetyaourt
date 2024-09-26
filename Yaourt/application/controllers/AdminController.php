<?
class AdminController extends CI_Controller {
    public function index() {
        $this->load->view('login_view');
    }

    public function login() {
        // Récupérer les données du formulaire
        $nomAdmin = $this->input->post('nomAdmin');
        $mdp = $this->input->post('mdp');
        
        // Charger le modèle et vérifier les informations
        $this->load->model('AdminModel');
        $admin = $this->AdminModel->verifyAdmin($nomAdmin, $mdp);
        
        if ($admin) {
            // Authentification réussie, stocker les informations en session
            $this->session->set_userdata('admin', $admin);
            echo "Connexion réussie !";
        } else {
            // Échec de l'authentification
            $this->session->set_flashdata('error', 'Nom d’utilisateur ou mot de passe incorrect.');
            redirect('AdminController/index');
        }
    }
}
?>