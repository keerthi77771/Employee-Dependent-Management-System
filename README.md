## 📌 **Employee & Dependent Management System**
![Project Screenshot](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%201.png)

### **🔹 Overview**
The **Employee & Dependent Management System** is a **web-based application** that allows organizations to manage employees and their dependents efficiently. It supports **CRUD operations (Create, Read, Update, Delete)** while ensuring **referential integrity** using a **MySQL database**.

## 📜 **Features**
✅ **Employee Management** - Add, update, delete, and view employee records.  
✅ **Dependent Management** - Manage dependents tied to employee records with a **composite primary key**.  
✅ **Referential Integrity** - Uses `ON DELETE CASCADE` to maintain data consistency.  
✅ **Database Validation** - Ensures no duplicate SSNs, missing fields, or bad inputs.  
✅ **Error Handling** - Robust form validations at both **application and database levels**.  
✅ **Web-Based** - Accessible via a browser using a **WAMP/LAMP stack**.  


## 🛠 **Tech Stack**
| Layer         | Technology Used |
|--------------|----------------|
| **Frontend** | HTML, CSS, JavaScript |
| **Backend**  | PHP |
| **Database** | MySQL |
| **Development Environment** | WAMP (Windows, Apache, MySQL, PHP) |


## ⚙️ **Installation & Setup**
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
1. Open `config.php` in the project folder.
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

## 📂 **Project Structure**
```
Employee-Dependent-Management-System/
│── Images/                     # Project Screenshots
│── database.sql                 # Database Schema
│── index.php                    # Homepage
│── config.php                    # Database Configuration
│── employees.php                 # Employee Management
│── dependents.php                # Dependent Management
│── assets/                       # CSS, JS files
└── README.md                     # Documentation
```

## 🛡 **Data Validation & Security**
### **✅ Application-Level Validation**
- HTML form attributes (`required`, `pattern`) ensure correct input.
- PHP validation checks SSN format, uniqueness, and missing fields.

### **✅ Database-Level Validation**
- **SSN** is a **primary key** (`UNIQUE` constraint).
- **Dependent (SSN + Name)** is a **composite primary key**.
- **Foreign Key Constraints** prevent orphaned records.

## 📸 **Screenshots**
🔹 **Homepage**
![Homepage](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%201.png)

🔹 **Employee List**
![Employee List](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%202.png)

🔹 **Add Employee Form**
![Add Employee](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%203.png)

🔹 **Add Employee Form**
![Add Employee](https://github.com/keerthi77771/Employee-Dependent-Management-System/blob/main/Images/EMS%204.png)


## 🏆 **Why Use This System?**
🚀 **Easy Employee & Dependent Tracking** - Simple UI for adding & managing records.  
🔄 **Automatic Referential Integrity** - Prevents orphan records via **ON DELETE CASCADE**.  
🔐 **Robust Validation** - Ensures data integrity with **client-side & database validation**.  
🌐 **Web-Based Access** - Works in any modern browser via **WAMP/LAMP server**.  


## 📝 **Contributing**
Want to improve this project? Follow these steps:

1. **Fork the Repository**
2. **Create a Branch** (`git checkout -b feature-branch`)
3. **Make Changes & Commit** (`git commit -m "Added feature XYZ"`)
4. **Push to GitHub** (`git push origin feature-branch`)
5. **Submit a Pull Request**


## 🤝 **Contact & Support**
For issues or feature requests, open a [GitHub Issue](https://github.com/keerthi77771/Employee-Dependent-Management-System/issues).  

### 🚀 **Star ⭐ this repository if you found it useful!**  
Let me know if you need any modifications! 😊
