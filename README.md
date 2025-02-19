
# **Employee & Dependent Management System**
![Project Screenshot](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%204.png)

## **📌 Overview**
The **Employee & Dependent Management System** is a web-based application that allows organizations to efficiently manage employees and their dependents. It supports **CRUD operations (Create, Read, Update, Delete)** while ensuring **referential integrity** using a **MySQL database**.

### **🔹 Key Features**
✅ **Employee Management** - Add, edit, delete, and view employees.  
✅ **Dependent Management** - Manage dependents associated with employees.  
✅ **Referential Integrity** - Uses `ON DELETE CASCADE` to maintain consistency.  
✅ **Error Handling** - Robust validation at both application and database levels.  
✅ **Web-Based UI** - Works via a **browser using PHP & MySQL**.  

---

## **🛠 Tech Stack**
| Component    | Technology Used |
|-------------|----------------|
| **Frontend** | HTML, CSS, JavaScript |
| **Backend**  | PHP |
| **Database** | MySQL |
| **Server**   | WAMP/LAMP (Windows, Apache, MySQL, PHP) |

---

## **📂 Project Directory Structure**
```
Employee-Dependent-Management-System/
│── Images/                     # Project Screenshots
│   ├── EMS 1.png
│   ├── EMS 2.png
│   ├── EMS 3.png
│   ├── EMS 4.png
│── css/                         # Stylesheets
│   ├── style.css
│── includes/                    # Database Config & Includes
│   ├── db_connection.php
│── add_dependent.php            # Add dependent functionality
│── add_employee.php             # Add employee functionality
│── delete_dependent.php         # Delete dependent functionality
│── delete_employee.php          # Delete employee functionality
│── edit_dependent.php           # Edit dependent details
│── edit_employee.php            # Edit employee details
│── index.php                    # Homepage
│── view_dependents.php          # View all dependents
│── view_employees.php           # View all employees
│── README.md                    # Documentation
```

---

## **⚙️ Installation & Setup**
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/keerthi77771/Employee-Dependent-Management-System.git
cd Employee-Dependent-Management-System
```

### **2️⃣ Set Up the Database**
1. Open **phpMyAdmin**.
2. Create a **new database** (e.g., `employee_management`).
3. Import the provided SQL file:
   - Go to **Import** → Upload `database.sql` → Click **Go**.

### **3️⃣ Configure Database Connection**
1. Open `includes/db_connection.php`.
2. Set your database credentials:
   ```php
   $servername = "localhost";
   $username = "root";  // Change if necessary
   $password = "";      // Change if necessary
   $dbname = "employee_management";
   ```
3. Save and close the file.

### **4️⃣ Run the Project**
- Start your **WAMP/LAMP** server.
- Open your browser and visit:
  ```
  http://localhost/Employee-Dependent-Management-System/
  ```

---

## **🛡 Data Validation & Security**
### ✅ **Application-Level Validation**
- **Frontend Validation**: Uses HTML form attributes (`required`, `pattern`) to prevent bad input.
- **Backend Validation**: PHP ensures correct **SSN format**, **uniqueness**, and **non-empty fields**.

### ✅ **Database-Level Validation**
- **SSN is a primary key** (`UNIQUE` constraint).
- **Dependent (SSN + Name) is a composite key**.
- **Foreign Key Constraints**: Prevent orphaned records.

---

## **📸 Screenshots**
🔹 **Homepage**
![Homepage](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%201.png)

🔹 **Employee List**
![Employee List](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%202.png)

🔹 **Add Employee Form**
![Add Employee](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%203.png)

🔹 **Edit Employee**
![Edit Employee](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%204.png)

---

## **🏆 Why Use This System?**
🚀 **Easy Employee & Dependent Tracking** - Simple UI for adding & managing records.  
🔄 **Automatic Referential Integrity** - Prevents orphan records via **ON DELETE CASCADE**.  
🔐 **Robust Validation** - Ensures data integrity with **client-side & database validation**.  
🌐 **Web-Based Access** - Works in any modern browser via **WAMP/LAMP server**.  

---

## **📝 Contributing**
Want to improve this project? Follow these steps:

1. **Fork the Repository**
2. **Create a Branch** (`git checkout -b feature-branch`)
3. **Make Changes & Commit** (`git commit -m "Added feature XYZ"`)
4. **Push to GitHub** (`git push origin feature-branch`)
5. **Submit a Pull Request**


### ⭐ **Star this repository if you found it useful!**  
Let me know if you need any modifications! 😊🚀
