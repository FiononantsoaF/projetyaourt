<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class ChargeGeneralModel extends CI_Model {
    
        protected $table = 'chargeGeneral';
    
        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function getAllCharges() {
            return $this->db->get($this->table)->result();
        }

        public function getChargeById($id) {
            return $this->db->where('idCharge', $id)->get($this->table)->row();
        }

        public function insertCharge($data) {
            return $this->db->insert($this->table, $data);
        }

        public function updateCharge($id, $data) {
            return $this->db->where('idCharge', $id)->update($this->table, $data);
        } 

        public function deleteCharge($id) {
            return $this->db->where('idCharge', $id)->delete($this->table);
        }

        public function insertChargeGeneral($data) {
            // Insérer les données dans la table chargeGeneral
            $this->db->insert('chargeGeneral', [
                'nomCharge' => $data['nomCharge'],
                'montant' => $data['montant'],
                'daty' => $data['daty']
            ]);
    
            // Récupérer l'ID généré
            $idGeneral = $this->db->insert_id();
            
            // Les centres à traiter
            $centres = [1, 2, 3, 4];
            
            // Insérer les répartitions pour chaque centre
            foreach ($centres as $idCentre) {
                $pourcentage = isset($data['pourcentages'][$idCentre]) ? $data['pourcentages'][$idCentre] : 0;
    
                $this->db->insert('repartition', [
                    'idGeneral' => $idGeneral,
                    'idCentre' => $idCentre,
                    'idUnite' => $data['idUnite'],
                    'idNature' => $data['idNature'],
                    'pourcentage' => $pourcentage
                ]);
            }
    
            return $idGeneral;
        }

        public function getRepartitionData() {
            // Requête pour récupérer les données à partir de la vue vueRepartitionAvecCalculs
            $query = $this->db->query("SELECT idCharge, nomCharge, montant, montantFixe, montantVariable, nomUnite, nomNature, idCentre, pourcentage FROM vueRepartitionAvecCalculs");
            
            $data = [];
            
            foreach ($query->result_array() as $row) {
                $idCharge = $row['idCharge'];
                
                if (!isset($data[$idCharge])) {
                    $data[$idCharge] = [
                        'nomCharge' => $row['nomCharge'],
                        'montant' => $row['montant'],
                        'nomUnite' => $row['nomUnite'],
                        'nomNature' => $row['nomNature'],
                        'pourcentage1' => 0,
                        'fixe1' => 0,
                        'variable1' => 0,
                        'pourcentage2' => 0,
                        'fixe2' => 0,
                        'variable2' => 0,
                        'pourcentage3' => 0,
                        'fixe3' => 0,
                        'variable3' => 0,
                        'pourcentage4' => 0,
                        'fixe4' => 0,
                        'variable4' => 0,
                        'totalFixe' => 0, 
                        'totalVariable' => 0 
                    ];
                }
    
                switch ($row['idCentre']) {
                    case 1:
                        $data[$idCharge]['pourcentage1'] = $row['pourcentage'];
                        $data[$idCharge]['fixe1'] = round($row['montantFixe'], 2); 
                        $data[$idCharge]['variable1'] = round($row['montantVariable'], 2);
                        break;
                    case 2:
                        $data[$idCharge]['pourcentage2'] = $row['pourcentage'];
                        $data[$idCharge]['fixe2'] = round($row['montantFixe'], 2);
                        $data[$idCharge]['variable2'] = round($row['montantVariable'], 2);
                        break;
                    case 3:
                        $data[$idCharge]['pourcentage3'] = $row['pourcentage'];
                        $data[$idCharge]['fixe3'] = round($row['montantFixe'], 2);
                        $data[$idCharge]['variable3'] = round($row['montantVariable'], 2);
                        break;
                    case 4:
                        $data[$idCharge]['pourcentage4'] = $row['pourcentage'];
                        $data[$idCharge]['fixe4'] = round($row['montantFixe'], 2);
                        $data[$idCharge]['variable4'] = round($row['montantVariable'], 2);
                        break;
                }
    
                // Calculer les totaux fixe et variable
                $data[$idCharge]['totalFixe'] = round($data[$idCharge]['fixe1'] + $data[$idCharge]['fixe2'] + $data[$idCharge]['fixe3'] + $data[$idCharge]['fixe4'], 2);
                $data[$idCharge]['totalVariable'] = round($data[$idCharge]['variable1'] + $data[$idCharge]['variable2'] + $data[$idCharge]['variable3'] + $data[$idCharge]['variable4'], 2);
            }
    
            $this->createTxtFile($data);
            return $data;
        }

        public function somme() {
            $queryMontant = $this->db->query("
                SELECT 
                    SUM(montant) AS sommeMontant
                FROM 
                    chargeGeneral
            ");
    
            $queryRepartition = $this->db->query("
                SELECT 
                    SUM(CASE WHEN idCentre = 1 THEN montantFixe ELSE 0 END) AS sommeFixe1,
                    SUM(CASE WHEN idCentre = 1 THEN montantVariable ELSE 0 END) AS sommeVariable1,
                    SUM(CASE WHEN idCentre = 2 THEN montantFixe ELSE 0 END) AS sommeFixe2,
                    SUM(CASE WHEN idCentre = 2 THEN montantVariable ELSE 0 END) AS sommeVariable2,
                    SUM(CASE WHEN idCentre = 3 THEN montantFixe ELSE 0 END) AS sommeFixe3,
                    SUM(CASE WHEN idCentre = 3 THEN montantVariable ELSE 0 END) AS sommeVariable3,
                    SUM(CASE WHEN idCentre = 4 THEN montantFixe ELSE 0 END) AS sommeFixe4,
                    SUM(CASE WHEN idCentre = 4 THEN montantVariable ELSE 0 END) AS sommeVariable4
                FROM 
                    vueRepartitionAvecCalculs
            ");
    
            $resultMontant = $queryMontant->row_array();
            $resultRepartition = $queryRepartition->row_array();
    
            return [
                'sommeMontant' => round($resultMontant['sommeMontant'], 2), 
                'sommeCentre1' => round($resultRepartition['sommeFixe1'] + $resultRepartition['sommeVariable1'], 2),
                'sommeCentre2' => round($resultRepartition['sommeFixe2'] + $resultRepartition['sommeVariable2'], 2),
                'sommeCentre3' => round($resultRepartition['sommeFixe3'] + $resultRepartition['sommeVariable3'], 2),
                'sommeCentre4' => round($resultRepartition['sommeFixe4'] + $resultRepartition['sommeVariable4'], 2),
                'sommeTotalFixe' => round($resultRepartition['sommeFixe1'] + $resultRepartition['sommeFixe2'] + $resultRepartition['sommeFixe3'] + $resultRepartition['sommeFixe4'], 2),
                'sommeTotalVariable' => round($resultRepartition['sommeVariable1'] + $resultRepartition['sommeVariable2'] + $resultRepartition['sommeVariable3'] + $resultRepartition['sommeVariable4'], 2),
            ];
        }

        private function createTxtFile($data) {
            $filename = 'grand_taleau.txt';
            $file = fopen($filename, 'w');
    
            $headers = "rubrique;total;unite d'oeuvre;nature;"
                     . "Production/pourcentage;Production/fixe;Production/variable;"
                     . "Conditionnement/pourcentage;Conditionnement/fixe;Conditionnement/variable;"
                     . "Distribution & Logistique/pourcentage;Distribution & Logistique/fixe;Distribution & Logistique/variable;"
                     . "Administration/pourcentage;Administration/fixe;Administration/variable;"
                     . "TotalFixe;TotalVariable\n";
            fwrite($file, $headers);
    
            foreach ($data as $idCharge => $values) {
                $line = "{$values['nomCharge']};{$values['montant']};{$values['nomUnite']};{$values['nomNature']};"
                      . "{$values['pourcentage1']};{$values['fixe1']};{$values['variable1']};"
                      . "{$values['pourcentage2']};{$values['fixe2']};{$values['variable2']};"
                      . "{$values['pourcentage3']};{$values['fixe3']};{$values['variable3']};"
                      . "{$values['pourcentage4']};{$values['fixe4']};{$values['variable4']};"
                      . "{$values['totalFixe']};{$values['totalVariable']}\n";
                fwrite($file, $line);
            }
    
            // Fermer le fichier
            fclose($file);
        }

        /////////////////////////////////   REPARTITION PAR CENTRE ///////////////////////////////////////////////
        public function repartitionAdmin() {
            $db = $this->load->database(); // Chargez votre base de données si nécessaire
    
            // Appelez la méthode somme() qui doit être définie dans votre modèle
            $dataSomme = $this->somme($db);
    
            // Extraire les sommes de chaque centre
            $somme1 = $dataSomme['sommeCentre1']; // Production
            $somme2 = $dataSomme['sommeCentre2']; // Conditionnement
            $somme3 = $dataSomme['sommeCentre3']; // Distribution & Logistique
            $somme4 = $dataSomme['sommeCentre4']; // Somme administrative
    
            // Calculer la somme totale
            $sommeTotal = $somme1 + $somme2 + $somme3;
    
            // Calculer les pourcentages pour chaque centre
            $pourcentageCentre1 = $sommeTotal ? ($somme1 * 100) / $sommeTotal : 0;
            $pourcentageCentre2 = $sommeTotal ? ($somme2 * 100) / $sommeTotal : 0;
            $pourcentageCentre3 = $sommeTotal ? ($somme3 * 100) / $sommeTotal : 0;
    
            // Calculer les sommes administratives
            $sommeAdmin1 = ($somme4 * $pourcentageCentre1) / 100;
            $sommeAdmin2 = ($somme4 * $pourcentageCentre2) / 100;
            $sommeAdmin3 = ($somme4 * $pourcentageCentre3) / 100;
    
            // Calculer les coûts totaux
            $coutTotal1 = $somme1 + $sommeAdmin1;
            $coutTotal2 = $somme2 + $sommeAdmin2;
            $coutTotal3 = $somme3 + $sommeAdmin3;
    
            // Calculer le coût final
            $coutFinal = $coutTotal1 + $coutTotal2 + $coutTotal3;
    
            // Formater les résultats sans number_format()
            $resultats = [
                [
                    'nomCentre' => 'Production',
                    'somme' => round($somme1, 2),
                    'pourcentage' => round($pourcentageCentre1, 2),
                    'sommeAdmin' => round($sommeAdmin1, 2),
                    'coutTotal' => round($coutTotal1, 2)
                ],
                [
                    'nomCentre' => 'Conditionnement',
                    'somme' => round($somme2, 2),
                    'pourcentage' => round($pourcentageCentre2, 2),
                    'sommeAdmin' => round($sommeAdmin2, 2),
                    'coutTotal' => round($coutTotal2, 2)
                ],
                [
                    'nomCentre' => 'Distribution & Logistique',
                    'somme' => round($somme3, 2),
                    'pourcentage' => round($pourcentageCentre3, 2),
                    'sommeAdmin' => round($sommeAdmin3, 2),
                    'coutTotal' => round($coutTotal3, 2)
                ],
                [
                    'Total' => 'Total Général',
                    'somme' => round($sommeTotal, 2),
                    'pourcentage' => '-',
                    'sommeAdmin' => round($somme4, 2),
                    'coutTotal' => round($coutFinal, 2)
                ]
            ];
    
            // Appeler la fonction fileCentre pour enregistrer les résultats
            $this->fileCentre($resultats);
            return $resultats; 
        }
    
        public function fileCentre($data) {
            $filename = 'repartition_centre.txt';
            $file = fopen($filename, 'w');
    
            $headers = "preparation adm/distr;cout directe;cles;adm/dist;cout total\n";     
            fwrite($file, $headers);
    
            foreach ($data as $row) {
                if (isset($row['nomCentre'])) {
                    // Pour les centres (Production, Conditionnement, Distribution & Logistique)
                    $line = "{$row['nomCentre']};{$row['somme']};{$row['pourcentage']};{$row['sommeAdmin']};{$row['coutTotal']}\n";
                } elseif (isset($row['Total'])) {
                    // Pour le total général
                    $line = "{$row['Total']};{$row['somme']};{$row['pourcentage']};{$row['sommeAdmin']};{$row['coutTotal']}\n";
                }
    
                fwrite($file, $line);
            }
    
            fclose($file);
            echo "Fichier mis à jour avec succès: $filename\n";
        }
    }
?>