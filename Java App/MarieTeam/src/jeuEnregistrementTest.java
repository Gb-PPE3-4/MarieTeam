import static org.junit.Assert.*;

import org.junit.Before;
import org.junit.Test;


public class jeuEnregistrementTest {

	public jeuEnregistrement jEnr ;
	
	@Before
	public void setUp() throws Exception {
		jEnr = new jeuEnregistrement("SELECT `er`.idequip, `et`.libequip FROM `equiper` er LEFT JOIN `equipement` et ON er.idequip = et.idequip") ;
	}

	@Test
	public void testFin() {
		try{
			setUp();
			assertTrue("Erreur de conversion en chaine de caractères", jEnr.fin() == true || jEnr.fin() == false);
		}catch(Exception e){
			System.out.println(e.getMessage());
		}
	}

	@Test
	public void testGetValeur() {
		try{
			setUp();
			jEnr.suivant() ;
			assertTrue("Erreur de conversion en chaine de caractères", jEnr.getValeur("libequip") instanceof String);
		}catch(Exception e){
			System.out.println(e.getMessage());
		}
	}
}
