import java.util.*;
/**
 * <b>BateauVoyageur classe représentant un bateau de voyageur et ses attributs spécifiques (avec héritage de Bateau)</b>
 * <p>
 * Un bateau voyageur est caractérisé par les informations suivantes :
 * <ul>
 * <li>Une vitesse en noeuds.</li>
 * <li>Une image.</li>
 * <li>Une collection d'instances de classe Equipement.</li>
 * </ul>
 * </p>
 * 
 * @author pierre vandesompele, raphael polowczak, robin faure
 */
public class BateauVoyageur extends Bateau {
	
	private String vitesseBatVoy ;
	private String imageBatVoyageur ;
	private ArrayList<Equipement> collEquip = new ArrayList<Equipement>() ;
	
    /**
     * Constructeur BateauVoyageur vide.
     */
	public BateauVoyageur() {
		super();
		vitesseBatVoy = new String() ;
		imageBatVoyageur = new String() ;
		collEquip = new ArrayList<Equipement>() ;
	}
	
    /**
     * Constructeur Bateau.
     * 
     * @param id
     *            L'identifiant unique du Bateau.
     * @param nom
     *            Le nom.
     * @param uneLongueur
     *            Longueur.
     * @param uneLargeur
     *            La largeur.
     * @param unHeritage
     *            L'entier représente l'héritage batea (0 pour voyageur, 1 pour fret).
     * @param uneVitesse
     *            La vitesse du bateau de voyageurs.
     * @param uneImage
     *            La photo du navire.
     * @param uneCollEquip
     *            La collection d'instances de classe Equipement.
     */
	public BateauVoyageur(int unId, String unNom, String uneLongueur,String uneLargeur, int unHeritage,String uneVitesse,String uneImage, ArrayList uneCollEquip) {
		super(unId, unNom, uneLongueur, uneLargeur, unHeritage);
		vitesseBatVoy = uneVitesse;
		imageBatVoyageur = uneImage ;
		collEquip = uneCollEquip ;
	}

    /**
     * Renvoie une chaine appropriee pour le PDF avec tous les attributs BVOYAGEUR avec SUPER.
     * 
     * @return Renvoie une chaine appropriee pour le PDF avec tous les attributs BVOYAGEUR avec SUPER.
     * 
     */
	public String toString(){
		String resultat = new String() ;
		String mot1 = "Vitesse : " + vitesseBatVoy + " noeuds." ; 
		String mot2 = "Liste des équipements du bateau : " ; 
		String Newligne =  System.getProperty("line.separator") ;
		
		resultat = super.toString() + Newligne + mot1 + Newligne + mot2 ; 
		
		// Recuperation des equipements
		for( Equipement unEquipement : collEquip ){
			String mot3 = unEquipement.toString();
			resultat = resultat + Newligne + mot3;
		}
		
		return resultat ;
	}
	
	// Getters & Setters
	
	public String getVitesse() {
		return vitesseBatVoy;
	}

	public void setVitesse(String vitesse) {
		this.vitesseBatVoy = vitesse;
	}

	public String getImageBatVoyageur() {
		return imageBatVoyageur;
	}

	public void setImageBatVoyageur(String imageBatVoyageur) {
		this.imageBatVoyageur = imageBatVoyageur;
	}

	public ArrayList<Equipement> getCollEquip() {
		return collEquip;
	}

	public void setCollEquip(ArrayList<Equipement> collEquip) {
		this.collEquip = collEquip;
	}
}
