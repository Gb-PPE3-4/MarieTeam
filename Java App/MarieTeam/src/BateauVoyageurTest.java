

import static org.junit.Assert.*;

import java.util.ArrayList;

import org.junit.Before;
import org.junit.Test;

public class BateauVoyageurTest {

	public Bateau bVTest ;
	
	@Before
	public void setUp() throws Exception {
		Equipement unEquipmt = new Equipement(2, "unEquipement") ;
		ArrayList<Equipement> lstEq = new ArrayList<Equipement>() ;
		lstEq.add(unEquipmt) ;
		BateauVoyageur bVTest = new BateauVoyageur(15,"batVTest", "13", "7", 0, "13.5", "blabla", lstEq) ;
	}

	@Test
	public void testToString() {
		try{
			setUp() ;
			assertTrue("Erreur de conversion en chaine de caractères", bVTest.toString() instanceof String);
		}catch(Exception e){
			System.out.println(e.getMessage()+"-there's an exception!") ;
		}
	}


}
