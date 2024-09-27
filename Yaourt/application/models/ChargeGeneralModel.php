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

        // Insertion dans chargeGeneral et repartition
        public function insertChargeGeneral($data) {
            // Démarre une transaction
            $this->db->trans_start();

            $chargeData = [
                'nomCharge' => $data['nomCharge'],
                'montant' => $data['montant'],
                'daty' => $data['daty']
            ];
            
            // Insère la charge générale
            if (!$this->db->insert($this->table, $chargeData)) {
                $this->db->trans_rollback();
                return false;
            }
            
            // Récupère l'ID généré
            $idGeneral = $this->db->insert_id();
            
            $centres = [1, 2, 3, 4];

            // Insère les répartitions pour chaque centre
            foreach ($centres as $idCentre) {
                $pourcentage = isset($data['pourcentages'][$idCentre]) ? $data['pourcentages'][$idCentre] : 0;
                
                $repartitionData = [
                    'idGeneral' => $idGeneral,
                    'idCentre' => $idCentre,
                    'idUnite' => $data['idUnite'],
                    'idNature' => $data['idNature'],
                    'pourcentage' => $pourcentage
                ];

                if (!$this->db->insert('repartition', $repartitionData)) {
                    $this->db->trans_rollback();
                    return false;
                }
            }
            $this->db->trans_complete();
            return $idGeneral; 
        }

        public function getRepartitionData() {
            // Requête pour récupérer les données à partir de la vue vueRepartitionComplete
            $query = $this->db->query("SELECT idCharge, nomCharge, montant, nomUnite, nomNature, idCentre, pourcentage FROM vueRepartitionComplete");
    
            $data = [];
    
            foreach ($query->result() as $row) {
                $idCharge = $row->idCharge;
    
                if (!isset($data[$idCharge])) {
                    $data[$idCharge] = [
                        'nomCharge' => $row->nomCharge,
                        'montant' => $row->montant,
                        'nomUnite' => $row->nomUnite,
                        'nomNature' => $row->nomNature,
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
    
                // Remplir le pourcentage en fonction du centre
                switch ($row->idCentre) {
                    case 1:
                        $data[$idCharge]['pourcentage1'] = $row->pourcentage;
                        break;
                    case 2:
                        $data[$idCharge]['pourcentage2'] = $row->pourcentage;
                        break;
                    case 3:
                        $data[$idCharge]['pourcentage3'] = $row->pourcentage;
                        break;
                    case 4:
                        $data[$idCharge]['pourcentage4'] = $row->pourcentage;
                        break;
                }
    
            // Calculer fixe et variable en fonction de nomNature
            $montant = $row->montant;

            if ($row->nomNature === 'Fixe') {
                $data[$idCharge]['fixe1'] = ($data[$idCharge]['pourcentage1'] / 100) * $montant;
                $data[$idCharge]['fixe2'] = ($data[$idCharge]['pourcentage2'] / 100) * $montant;
                $data[$idCharge]['fixe3'] = ($data[$idCharge]['pourcentage3'] / 100) * $montant;
                $data[$idCharge]['fixe4'] = ($data[$idCharge]['pourcentage4'] / 100) * $montant;

                $data[$idCharge]['totalFixe'] = $data[$idCharge]['fixe1'] + $data[$idCharge]['fixe2'] + $data[$idCharge]['fixe3'] + $data[$idCharge]['fixe4'];
            } elseif ($row->nomNature === 'Variable') {
                $data[$idCharge]['variable1'] = ($data[$idCharge]['pourcentage1'] / 100) * $montant;
                $data[$idCharge]['variable2'] = ($data[$idCharge]['pourcentage2'] / 100) * $montant;
                $data[$idCharge]['variable3'] = ($data[$idCharge]['pourcentage3'] / 100) * $montant;
                $data[$idCharge]['variable4'] = ($data[$idCharge]['pourcentage4'] / 100) * $montant;

                $data[$idCharge]['totalVariable'] = $data[$idCharge]['variable1'] + $data[$idCharge]['variable2'] + $data[$idCharge]['variable3'] + $data[$idCharge]['variable4'];
            }
        }
    
        $this->createTxtFile($data);
        return $data;
    }
    
    public function somme() {

        $data = $this->getRepartitionData();

        // Initialiser les totaux
        $totalMontant = 0;
        $totalFixe1 = 0;
        $totalVariable1 = 0;
        $totalFixe2 = 0;
        $totalVariable2 = 0;
        $totalFixe3 = 0;
        $totalVariable3 = 0;
        $totalFixe4 = 0;
        $totalVariable4 = 0;
        $totalTotalFixe = 0;
        $totalTotalVariable = 0;

        // Parcourir les données et calculer les sommes
        foreach ($data as $nomCharge => $values) {
            $totalMontant += $values['montant'];
            $totalFixe1 += $values['fixe1'];
            $totalVariable1 += $values['variable1'];
            $totalFixe2 += $values['fixe2'];
            $totalVariable2 += $values['variable2'];
            $totalFixe3 += $values['fixe3'];
            $totalVariable3 += $values['variable3'];
            $totalFixe4 += $values['fixe4'];
            $totalVariable4 += $values['variable4'];
            $totalTotalFixe += $values['totalFixe'];
            $totalTotalVariable += $values['totalVariable'];
        }

        // Créer un tableau avec les résultats
        $sommeData = [
            'sommeMontant' => $totalMontant,
            'sommeCentre1' => $totalFixe1 + $totalVariable1,
            'sommeCentre2' => $totalFixe2 + $totalVariable2,
            'sommeCentre3' => $totalFixe3 + $totalVariable3,
            'sommeCentre4' => $totalFixe4 + $totalVariable4,
            'sommeTotalFixe' => $totalTotalFixe,
            'sommeTotalVariable' => $totalTotalVariable,
        ];

        return $sommeData; 
    }
    
    public function createTxtFile($data) {
        $filename = 'repartition_data.txt';

        // Ouvrir le fichier en mode écriture pour effacer son contenu précédent
        $file = fopen($filename, 'w');

        // Écrire les en-têtes dans le fichier
        $headers = "rubrique;total;unite d'oeuvre;nature;Production/pourcentage;Production/fixe;Production/variable;"
                 . "Conditionnement/pourcentage;Conditionnement/fixe;Conditionnement/variable;"
                 . "Distribution & Logistique/pourcentage;Distribution & Logistique/fixe;Distribution & Logistique/variable;"
                 . "Administration/pourcentage;Administration/fixe;Administration/variable;TotalFixe;TotalVariable\n";
        fwrite($file, $headers);

        // Écrire les données ligne par ligne
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
        echo "Fichier mis à jour avec succès: $filename\n";
    }

    public function repartitionAdmin() {
        $dataSomme = $this->somme();
    
        // Extraire les sommes de chaque centre
        $somme1 = $dataSomme['sommeCentre1'];
        $somme2 = $dataSomme['sommeCentre2'];
        $somme3 = $dataSomme['sommeCentre3'];
        $somme4 = $dataSomme['sommeCentre4'];
    
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
    
        // Formater les résultats avec 2 chiffres après la virgule
        $resultats = [
            [
                'nomCentre' => 'Production',
                'somme' => number_format($somme1, 2),
                'pourcentage' => number_format($pourcentageCentre1, 2),
                'sommeAdmin' => number_format($sommeAdmin1, 2),
                'coutTotal' => number_format($coutTotal1, 2)
            ],
            [
                'nomCentre' => 'Conditionnement',
                'somme' => number_format($somme2, 2),
                'pourcentage' => number_format($pourcentageCentre2, 2),
                'sommeAdmin' => number_format($sommeAdmin2, 2),
                'coutTotal' => number_format($coutTotal2, 2)
            ],
            [
                'nomCentre' => 'Distribution & Logistique',
                'somme' => number_format($somme3, 2),
                'pourcentage' => number_format($pourcentageCentre3, 2),
                'sommeAdmin' => number_format($sommeAdmin3, 2),
                'coutTotal' => number_format($coutTotal3, 2)
            ],
            [
                'Total' => 'Total General',
                'somme' => number_format($sommeTotal, 2),
                'pourcentage' => '-',
                'sommeAdmin' => number_format($somme4, 2),
                'coutTotal' => number_format($coutFinal, 2)
            ]
        ];
    
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