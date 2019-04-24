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
	
	// test for error message when first name field is left empty on signup page
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
    
	// test of error message when first name provided is too short on signup page
	@Test
	public void testInvalidFirstName() {
		
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
        driver.manage().window().maximize();
    	
        driver.findElement(By.name("fname")).sendKeys("Ch");
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
    	assertEquals(errorMsg, "First name must contain at least 3 characters.");
	}
	
	// test of error message when last name field is left empty on signup page
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
	
	// test of error message when last name provided is too short on signup page
	@Test
	public void testInvalidLastName() {
		
		driver.get("http://localhost/GTM-Web-Application-V2/signup.php");
        driver.manage().window().maximize();
    	
        driver.findElement(By.name("fname")).sendKeys("Christian");
    	driver.findElement(By.name("lname")).sendKeys("Be");
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
    	assertEquals(errorMsg, "Last name must contain at least 3 characters.");
	}
	
	// test error message when email field is empty on signup page
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
	
	// test error message when phone number field is empty on signup page
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
	
	// test error message when home address field is empty on signup page
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
	
	// test error message when city field is empty on signup page
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
	
	// test error message when state field is empty on signup page
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
	
	// test error message when zip code field is empty on signup page
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
	
	// test error message when password field is empty on signup page
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
	
	// test error message when password provided is too short on signup page
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
	
	// test error message when confirm password field is empty on signup page
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
	
	// test error message when password does not match confirm password field on signup page
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
	
	// test Home nav bar link on index page
	@Test
	public void testHome() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("HOME")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#top");
	}
	
	// test About nav bar link on index page
	@Test
	public void testAboutUs() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("ABOUT US")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#about");
	}
	
	// test Services nav bar link on index page
	@Test
	public void testServices() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("SERVICES")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#services");
	}
	
	// test Meet The Team nav bar link on index page
	@Test
	public void testMeetTheTeam() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("MEET THE TEAM")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#team");
	}
	
	// test Contact Us nav bar link on index page
	@Test
	public void testContactUs() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("CONTACT US")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/index.php#contact");
	}
	
	// test Schedule Appointment link on index page
	@Test
	public void testScheduleAnAppointment() {
		driver.get("http://localhost/GTM-Web-Application-V2/index.php");
	    driver.manage().window().maximize();
	         
	    driver.manage().timeouts().implicitlyWait(4, TimeUnit.SECONDS);
	    driver.findElement(By.linkText("Schedule An Appointment")).click();
	         
	    String currentURL = driver.getCurrentUrl();
	    assertEquals(currentURL, "http://localhost/GTM-Web-Application-V2/login.php");
	}
	
	// test error message for duplicate email in database
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
	
	// 1.1.3
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
	
	// 1.2.3
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
    
	// 1.2.4
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
    
	// 1.1.8
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
	
	// 1.1.11
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
    
	/*
	 * // tests to see if account activation link public static void
	 * testAccountVerificationLink(WebDriver driver) throws InterruptedException {
	 * 
	 * driver.get("http://www.gmail.com"); driver.manage().window().maximize();
	 * driver.manage().timeouts().implicitlyWait(3, TimeUnit.SECONDS);
	 * 
	 * driver.findElement(By.cssSelector("#Email")).sendKeys(
	 * "Christian.8edwell@gmail.com");
	 * driver.findElement(By.cssSelector("#next")).click();
	 * driver.manage().timeouts().implicitlyWait(2, TimeUnit.SECONDS);
	 * driver.findElement(By.cssSelector("#Passwd")).sendKeys("mcswaggins");
	 * driver.findElement(By.cssSelector("#signIn")).click();
	 * 
	 * }
	 */
}