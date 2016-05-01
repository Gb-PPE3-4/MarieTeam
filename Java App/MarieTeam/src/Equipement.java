/**
 * <b>Equipement classe représentant un equipement.</b>
 * <p>
 * <ul>
 * <li>Un identifiant.</li>
 * <li>Un libelle.</li>
 * </ul>
 * </p>
 * 
 * @author pierre vandesompele, raphael polowczak, robin faure
 */
public class Equipement {
	
	private int idEquip;
	private String libEquip;

    /**
     * Constructeur Equipement.
     * 
     * @param unIdEquip
     *            L'identifiant unique de l'equipement.
     * @param unLibelle
     *            Le nom.
     */
	public Equipement(int unIdEquip, String unLibEquip){
		idEquip = unIdEquip ;
		libEquip = unLibEquip ;
	}

    /**
     * Renvoie une chaine appropriee pour le PDF avec le libelle EQUIPEMENT.
     * 
     * @return Renvoie une chaine appropriee pour le PDF avec le libelle EQUIPEMENT.
     * 
     */
	public String toString(){
		String resultat = new String() ;
		if(this.libEquip != "" && this.libEquip != null){
			resultat = " - " + libEquip ;
		}
		return resultat;
	}
		
	// Getters & Setters
	
	public int getIdEquip() {
		return idEquip;
	}

	public void setIdEquip(int idEquip) {
		this.idEquip = idEquip;
	}

	public String getLibEquip() {
		return libEquip;
	}

	public void setLibEquip(String libEquip) {
		this.libEquip = libEquip;
	}
}
