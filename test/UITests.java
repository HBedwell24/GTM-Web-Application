import static org.junit.Assert.assertEquals;
import org.junit.After;
import org.junit.Before;
import org.junit.Test;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.Select;

public class UITests {
	
	WebDriver driver;
	
	@Before
	public void startBrowser() {
		
		System.setProperty("webdriver.chrome.driver", "C:\\Users\\chris\\eclipse-workspace\\SeleniumProject\\chromedriver.exe");
		driver = new ChromeDriver();
		
	}
	
	@After
	public void shutDownDriver() {
		
		driver.close();
		
	}
	 	
	// test logo link on index page
	@Test
	public void testLogo() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.className("navbar-brand")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#top");
	}	
	
	// 1.1.5
	// The Web application shall check validity of the email 
	// address provided on the registration page.
	@Test
	public void testEmailValidity() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Email provided is invalid.");
	    	
	}
	
	// 1.1.6 - Unit Test
	// The Web application shall verify that the password provided on the 
	// registration page is 8 characters in length.
	@Test
	public void testInvalidPassword() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("1234");
	    driver.findElement(By.name("cpass")).sendKeys("1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String statusMsg = driver.findElement(By.id("status")).getText();
	    assertEquals(statusMsg, "Password must contain at least 8 characters.");
	}
	
	// 1.1.7 - Unit Test
	// The Web application shall check the password to verify that it matches 
	// the string inside the confirm password text box.
	@Test
	public void testUnmatchingPasswords() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test12355");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String statusMsg = driver.findElement(By.id("status")).getText();
	    assertEquals(statusMsg, "Password provided does not match.");
	}
	
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyFirstName() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
	
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyLastName() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
	
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyPhoneNumber() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
	
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyEmail() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyHomeAddress() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyCity() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	   	driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	   	driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    	
	   	WebElement state_dropdown = driver.findElement(By.name("state"));
	   	Select state_dd = new Select(state_dropdown);
    	state_dd.selectByIndex(10);
    	
	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyState() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyZipCode() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyPassword() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
	
	// 1.1.8 - Unit Test
	// The Web application shall prompt the user when not all of the fields on 
	// the registration page have been filled.
	@Test
	public void testEmptyConfirmPassword() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Please fill in all fields.");
	}
	
	// 1.1.9
	// test error message for duplicate email in database on registration page
	@Test
	public void testDuplicateEmail() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Hunter");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("bedwellhb@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33956");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "An account already exists with the email provided.");
	}
	
	// 1.1.12
	// Following creation of an account, the Web application shall 
	// send a verification email to the corresponding email account 
	// to ensure that the user is dual-authenticated.
	@Test
	public void testSignupPage() {
	    	
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("32354");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String statusMsg = driver.findElement(By.id("status")).getText();
	    assertEquals(statusMsg, "Please check your email for an account activation code.");
	    	
	}
	
	// 1.1.13 - Unit Test
	// The Web application shall check validity of the first name provided 
	// on the registration page.
	@Test
	public void testInvalidFirstName() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian80");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Invalid characters found in field 'First Name'. Please try again!");
	}
		
	// 1.1.13 - Unit Test
	// The Web application shall check validity of the first name provided 
	// on the registration page.
	@Test
	public void testInvalidLastName() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
	    driver.manage().window().maximize();
	    	
	    driver.findElement(By.name("fname")).sendKeys("Christian");
	    driver.findElement(By.name("lname")).sendKeys("Bedwell26");
	    driver.findElement(By.name("mail")).sendKeys("Christian.8edwell@gmail.com");
	    driver.findElement(By.name("phone")).sendKeys("(000) 000-0000");
	    driver.findElement(By.name("address")).sendKeys("1234 Bangalore Rd.");
	    driver.findElement(By.name("city")).sendKeys("Fort Myers");
	    	
	    WebElement state_dropdown = driver.findElement(By.name("state"));
	    Select state_dd = new Select(state_dropdown);
	    state_dd.selectByIndex(10);

	    driver.findElement(By.name("zcode")).sendKeys("33967");
	    driver.findElement(By.name("pass")).sendKeys("test1234");
	    driver.findElement(By.name("cpass")).sendKeys("test1234");
	    	
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.name("submit")).click();
	    	
	    String errorMsg = driver.findElement(By.className("error")).getText();
	    assertEquals(errorMsg, "Invalid characters found in field 'Last Name'. Please try again!");
	}
		
	// 1.1.15 - Integration Test
	// The Web application shall require email and password to login to an account.
	@Test
	public void testSuccessfulLogin() {
			
		driver.get("http://localhost/GTM-Web-Application-V2/login.php");
		driver.manage().window().maximize(); 
		driver.manage().timeouts().implicitlyWait(3, TimeUnit.SECONDS);
			
		WebElement email = driver.findElement(By.name("mail"));
		WebElement password = driver.findElement(By.name("pass"));
			
		email.sendKeys("bedwellhb@gmail.com");
		password.sendKeys("test1234");
		driver.findElement(By.name("submit")).click();
		assertEquals("GTM Home Services | Admin Panel", driver.getTitle());
			
	}
	
	// 1.1.16
	// The Web application shall prompt the user when not all of the 
	// fields on the login page have been filled.
	@Test
	public void testEmptyLoginEmail() {
				
		driver.get("http://localhost/GTM-Web-Application-V2/login.php");
		driver.manage().window().maximize();
		    	
		driver.findElement(By.name("pass")).sendKeys("test1234");
		    	
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.name("submit")).click();
		    	
		String errorMsg = driver.findElement(By.className("error")).getText();
		assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.16
	// The Web application shall prompt the user when not all of the 
	// fields on the login page have been filled.
	@Test
	public void testEmptyLoginPassword() {
					
		driver.get("http://localhost/GTM-Web-Application-V2/login.php");
		driver.manage().window().maximize();
			    	
		driver.findElement(By.name("mail")).sendKeys("bedwellhb@gmail.com");
			    	
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.name("submit")).click();
			    	
		String errorMsg = driver.findElement(By.className("error")).getText();
		assertEquals(errorMsg, "Please fill in all fields.");
	}
		
	// 1.1.19
	// The Web application shall prompt the user when the login process
	// was unsuccessful
	@Test
	public void testUnsuccessfulLogin() {
		
		driver.get("http://localhost/GTM-Web-Application-V2/login.php");
		driver.manage().window().maximize(); 
		driver.manage().timeouts().implicitlyWait(3, TimeUnit.SECONDS);
			
		WebElement email = driver.findElement(By.name("mail"));
			
		email.sendKeys("bedwellhb@gmail.com");
		driver.findElement(By.name("submit")).click();
		String errorMsg = driver.findElement(By.className("error")).getText();
		assertEquals(errorMsg, "Please fill in all fields.");
			
	}
	
	// 1.2.3 - Integration Test
	// The Web application shall allow the user to navigate to 
	// the login page from the landing page.
	@Test
	public void testLoginLink() {
	    	
	    driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("Log In")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/login.php");
	    
	}
    
	// 1.2.4 - Integration Test
	// The Web application shall allow the user to navigate to 
	// the registration page from the landing page.
	@Test
	public void testRegisterLink() {
    	
    	driver.get("http://localhost/GTM-Web-Application-V2/index.php");
        driver.manage().window().maximize();
         
        driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
        driver.findElement(By.linkText("Register")).click();
         
        String currentURL = driver.getCurrentUrl();
        assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/signup.php");
        
    }
	
	// 1.2.5
	// The Web application shall allow the user to navigate to the schedule 
	// appointment page from the landing page.
	@Test
	public void testScheduleAnAppointment() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
		driver.manage().window().maximize();
		         
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.linkText("Schedule An Appointment")).click();
		         
		String currentURL = driver.getCurrentUrl();
		assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/login.php");
	}
	
	// 1.2.6
	// The Web application shall allow the user to navigate to the 
	// Home section of the index page from the navigation bar.
	@Test
	public void testHome() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
		driver.manage().window().maximize();
		         
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.linkText("HOME")).click();
		         
		String currentURL = driver.getCurrentUrl();
		assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#top");
	}
		
	// 1.2.7
	// The Web application shall allow the user to navigate to the About Us 
	// section of the index page from the navigation bar.
	@Test
	public void testAboutUs() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
		driver.manage().window().maximize();
		         
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.linkText("ABOUT US")).click();
		         
		String currentURL = driver.getCurrentUrl();
		assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#about");
	}
		
	// 1.2.8
	// The Web application shall allow the user to navigate to the Services 
	// section of the index page from the navigation bar.
	@Test
	public void testServices() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
		driver.manage().window().maximize();
		         
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.linkText("SERVICES")).click();
		         
		String currentURL = driver.getCurrentUrl();
		assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#services");
	}
		
	// 1.2.9
	// The Web application shall allow the user to navigate to the Meet the Team 
	// section of the index page from the navigation bar.
	@Test
	public void testMeetTheTeam() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
		driver.manage().window().maximize();
		         
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.linkText("MEET THE TEAM")).click();
		         
		String currentURL = driver.getCurrentUrl();
		assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#team");
	}
		
	// 1.2.10
	// The Web application shall allow the user to navigate to the Contact Us 
	// section of the index page from the navigation bar.
	@Test
	public void testContactUs() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
		driver.manage().window().maximize();
		         
		driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
		driver.findElement(By.linkText("CONTACT US")).click();
		         
		String currentURL = driver.getCurrentUrl();
		assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#contact");
	}
}