1. Install Appserv
	- Will ask to install Microsoft Visual Studio if necessary
		- Install it
	- Server Name: localhost
	- Leave other attributes to default (ports, email, etc.)
	- Choose your root password for MySQL server (Username: root)
	- Start Apache and MySQL 
		- Allow access in windows firewall when promoted for permission
2. Install NetBeansIDE
3. Install MySQL front
4. Read MySQL Front Setup file provided
5. Read NetBeans Setup file provided

Read further if you want to run the provided demo files

Open MySQL front
1. Create a temp database in MySQL front
2. Right click on the database you just created, Import-> SQL file... and select the SQL file named demodb that came as part of this download

Open NetBeans
1. Import the php project: File -> Import Project -> From Zip
	a. In ZIP File: Click browse and open the provided ZIP file named "DemoWebsite"
	b. In Folder: Click browse and go to the location of "AppServ\www" folder in your computer and click save
	c. Click Import
3. Edit the values $password and $db variables in demoPage.php file in the Source Files folder to match them with your localhost password and database name that you just created
4. Run the project (click the play button)
	a. Setup Run Configuration
		1. Project URL: http://localhost/DemoWebsite
		2. Index File: demoPage.php
	b. Run the project and it should open your web browser with demoPage.php loaded
	c. You can also just open your web browse and type "http://localhost/DemoWebsite/demoPage.php" and it should load the page

Helpful Websites::

w3schools.com
tutorialspoint.com
google.com
youtube.com