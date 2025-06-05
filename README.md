# Donation Mini Project

The **Charity Donor Management System** is a web platform that connects donors with charities, enabling campaign creation, donation tracking, and digital receipts. Built using **PHP** and **MySQL**, the system includes an admin dashboard for monitoring and approvals — ensuring transparency, security, and ease in managing donations while encouraging social responsibility.

## ✨ Features

- Donors, charities, and admins can register and log in to access their respective dashboards.  
- Charities can create campaigns and submit donation requests, while donors can contribute and track their donations.  
- Admins review and approve campaigns to ensure authenticity and platform integrity.  
- The platform provides a responsive interface built with HTML, CSS, and JavaScript, ensuring ease of use across devices.  
- Built using PHP and MySQL, the system includes secure session management, real-time data handling, input validation, and is ready for local deployment via XAMPP.



## 🗂️ Database Configuration

To support the functionality of this system, the following tables should be created:


###  Charities Table
```sql
CREATE TABLE charities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    registered_datetime DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

### Campaigns Table

```sql
CREATE TABLE campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    charity_id INT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    goal_amount DECIMAL(10,2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (charity_id) REFERENCES charities(id) ON DELETE CASCADE
);
```

### Donations Table

```sql
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_id INT,
    campaign_id INT,
    amount DECIMAL(10,2) NOT NULL,
    donated_on DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (donor_id) REFERENCES donors(id) ON DELETE CASCADE,
    FOREIGN KEY (campaign_id) REFERENCES campaigns(id) ON DELETE SET NULL
);
```

### Donation Requests Table

```sql
CREATE TABLE donation_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    charity_id INT,
    campaign_id INT,
    description TEXT,
    requested_amount DECIMAL(10,2),
    FOREIGN KEY (charity_id) REFERENCES charities(id),
    FOREIGN KEY (campaign_id) REFERENCES campaigns(id)
);
```

## 🖼️ Screenshots

### Main Page

 ![Main Page](./Screenshots/mainPage.png)
![Main Page 2](./Screenshots/mainPage2.png)

---

### Donor Page

![Donor Page](./Screenshots/donorHome.png)