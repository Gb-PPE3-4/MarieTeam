
/**
 * <b>Bateau classe représentant un bateau et ses attributs les plus communs (avant pré-héritage)</b>
 * <p>
 * Un bateau est caractérisé par les informations suivantes :
 * <ul>
 * <li>Un identifiant unique attribué définitivement.</li>
 * <li>Un nom, suceptible d'être changé.</li>
 * <li>Une longueur en mettres.</li>
 * <li>Une largeur en mettres.</li>
 * </ul>
 * </p>
 * 
 * @author pierre vandesompele, raphael polowczak, robin faure
 */

public class Bateau {
	private int idbateau ;
	private String nom ;
	private String longueurBat ;
	private String largeurBat ;
	private int heritage ;


    /**
     * Constructeur Bateau.
     */
	public Bateau(){
		idbateau = 0 ;
		nom = new String() ;
		longueurBat = new String() ;
		largeurBat = new String() ;
	}

    /**
     * Constructeur Bateau.
     * 
     * @param id
     *            L'identifiant unique.
     * @param nom
     *            Le nom.
     * @param uneLongueur
     *            Longueur.
     * @param uneLargeur
     *            La largeur.
     * @param unHeritage
     *            L'entier représente l'héritage batea (0 pour voyageur, 1 pour fret).
     */
	public Bateau(int unId , String unNom , String uneLongueur , String uneLargeur, int unHeritage){
		idbateau = unId ;
		nom = unNom ;
		longueurBat = uneLongueur ;
		largeurBat = uneLargeur ;
		heritage = unHeritage ;
	}


    /**
     * Renvoie une chaine appropriee pour le PDF avec tous les attributs BATEAU.
     * 
     * @return Renvoie une chaine appropriee pour le PDF avec tous les attributs BATEAU
     * 
     */
	public String toString(){
		String mot1="Nom du bateau : " + nom ; 
		String mot2="Longueur : " + longueurBat + " mètres." ; 
		String mot3="Largeur : " + largeurBat + " mètres." ; 
		String Newligne=System.getProperty("line.separator") ; 
		String resultat = mot1 + Newligne + mot2 + Newligne + mot3 ; 
		return resultat ;
	}

	// Getters & Setters

	public int getIdbateau() {
		return idbateau;
	}

	public void setIdbateau(int idbateau) {
		this.idbateau = idbateau;
	}

	public String getNom() {
		return nom;
	}

	public void setNom(String nom) {
		this.nom = nom;
	}

	public String getLongueurBat() {
		return longueurBat;
	}

	public void setLongueurBat(String longueurBat) {
		this.longueurBat = longueurBat;
	}

	public String getLargeurBat() {
		return largeurBat;
	}

	public void setLargeurBat(String largeurBat) {
		this.largeurBat = largeurBat;
	}

	public int getHeritage() {
		return heritage;
	}

	public void setHeritage(int heritage) {
		this.heritage = heritage;
	}
}
