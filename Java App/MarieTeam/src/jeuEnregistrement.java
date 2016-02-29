import java.sql.* ;
import javax.ws.rs.core.Variant ;

public class jeuEnregistrement {

	ParametreBDD baseReq = null ;
    ResultSet jEnr = null ;
    
    // Constructeur avec une requete SQL et une possible clause WHERE (sinon "") -- Positionne le curseur sur le premier enregistrement
    public jeuEnregistrement(String sqlReq) throws ClassNotFoundException, SQLException{
    	baseReq = new ParametreBDD("root", "", "jdbc:mysql://localhost/marieteam_bd", "org.gjt.mm.mysql.Driver") ;
    	// sqlReq
    	jEnr = baseReq.reqLecture(sqlReq) ;
    }
    
    // Avance le curseur sur l'enregistrement suivant
    public boolean suivant() throws SQLException{
    	return this.jEnr.next() ;
    }
    
    // Indique sila marque de fin est atteinte
    public boolean fin() throws SQLException{
    	boolean testFin = false ;
    	if(suivant() == false){
    		testFin = true ;
    	}
    	return testFin ;
    }
    
    // Renvoie la valeur du champs du jEnr courant
    public String getValeur(String nomChamps) throws SQLException{
    	// jEnr.getString(nomChamps) ;
    	return jEnr.getString(nomChamps) ;
    }
    
    // Ferme le curseur et libere les ressources
    public void fermer() throws ClassNotFoundException, SQLException{
    	baseReq.seDeconnecterBDD() ;
    	jEnr = null ;
    }
}
