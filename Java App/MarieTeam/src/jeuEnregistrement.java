import java.sql.* ;
import javax.ws.rs.core.Variant ;
/**
 * <b>jeuEnregistrement classe technique utilisant la classe ParametreBDD pour récupérer un jeu de données.</b>
 * <p>
 * <ul>
 * <li>Une instance de ParametreBDD.</li>
 * <li>Un ResultSet.</li>
 * </ul>
 * </p>
 * 
 * @author pierre vandesompele, raphael polowczak, robin faure
 */
public class jeuEnregistrement {

	ParametreBDD baseReq = null ;
    ResultSet jEnr = null ;
    
    /**
     * Constructeur jeuEnregistrement avec une requete SQL -- Positionne le curseur sur le premier enregistrement.
     * 
     * @param sqlReq
     *            Une requete SQL .
     */
    public jeuEnregistrement(String sqlReq) throws ClassNotFoundException, SQLException{
    	baseReq = new ParametreBDD("root", "", "jdbc:mysql://localhost/marieteam_bd", "org.gjt.mm.mysql.Driver") ;
    	// sqlReq
    	jEnr = baseReq.reqLecture(sqlReq) ;
    }
    
    /**
     * Avance le curseur sur l'enregistrement suivant et renvoie un booleen.
     * 
     * @return Renvoie un bolean (TRUE si curseur sur ligne non vide).
     * 
     */
    public boolean suivant() throws SQLException{
    	return this.jEnr.next() ;
    }

    /**
     * Indique si la marque de fin est atteinte
     * 
     * @return Renvoie un bolean (FALSE si curseur sur ligne non vide).
     * 
     */
    public boolean fin() throws SQLException{
    	boolean testFin = false ;
    	if(suivant() == false){
    		testFin = true ;
    	}
    	return testFin ;
    }

    /**
     * Renvoie la valeur du champs du jEnr courant
     * 
     * @param nomChamps correspondant à un champs de la table
     * 
     * @return Renvoie une chaine de caractères quelque soit le type de valeur.
     * 
     */
    public String getValeur(String nomChamps) throws SQLException{
    	// jEnr.getString(nomChamps) ;
    	return jEnr.getString(nomChamps) ;
    }

    /**
     * Ferme le curseur et libere les ressources
     * 
     */
    public void fermer() throws ClassNotFoundException, SQLException{
    	baseReq.seDeconnecterBDD() ;
    	jEnr = null ;
    }
}
