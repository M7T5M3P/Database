-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 28 août 2024 à 06:15
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Database`
--

-- --------------------------------------------------------

--
-- Structure de la table `Room`
--

CREATE TABLE `Room` (
  `tables` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `style`
--

CREATE TABLE `style` (
  `id` varchar(255) NOT NULL,
  `style` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `style`
--

INSERT INTO `style` (`id`, `style`) VALUES
('allDiagram', 'body {\r\n            font-family: \'Open Sans\', sans-serif;\r\n            background-color: #f4f5f7;\r\n            color: #333;\r\n            padding: 20px;\r\n        }\r\n\r\n        .table-diagram {\r\n            display: inline-block;\r\n            margin: 20px;\r\n            padding: 20px;\r\n            border: 2px solid #007bff;\r\n            border-radius: 10px;\r\n            background-color: #ffffff;\r\n            width: 300px;\r\n            vertical-align: top;\r\n        }\r\n\r\n        .table-diagram h2 {\r\n            color: #007bff;\r\n            text-align: center;\r\n        }\r\n\r\n        .columns, .foreign-keys {\r\n            list-style: none;\r\n            padding: 0;\r\n        }\r\n\r\n        .columns li, .foreign-keys li {\r\n            margin: 5px 0;\r\n        }\r\n\r\n        .foreign-keys li {\r\n            font-style: italic;\r\n        }\r\n\r\n        .all-diagrams-container {\r\n            display: flex;\r\n            flex-wrap: wrap;\r\n            justify-content: center;\r\n        }\r\n\r\n        button.home {\r\n            background-color: #007bff;\r\n            color: white;\r\n            border: none;\r\n            padding: 12px 25px;\r\n            border-radius: 5px;\r\n            font-size: 16px;\r\n            cursor: pointer;\r\n            transition: background-color 0.3s ease;\r\n            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\r\n            margin-bottom: 30px;\r\n        }\r\n\r\n        button.home:hover {\r\n            background-color: #0056b3;\r\n        }'),
('createTable', 'body {\r\n            font-family: Arial, sans-serif;\r\n            background-color: #f4f4f9;\r\n            margin: 20px;\r\n        }\r\n        .container {\r\n            max-width: 800px;\r\n            margin: 0 auto;\r\n            background-color: #fff;\r\n            padding: 20px;\r\n            border-radius: 8px;\r\n            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);\r\n        }\r\n        h1 {\r\n            text-align: center;\r\n            color: #333;\r\n        }\r\n        form {\r\n            margin-top: 20px;\r\n        }\r\n        .input-group {\r\n            margin-bottom: 15px;\r\n        }\r\n        label {\r\n            font-weight: bold;\r\n        }\r\n        .input-group input, .input-group select {\r\n            width: 100%;\r\n            padding: 10px;\r\n            margin-top: 5px;\r\n            border: 1px solid #ccc;\r\n            border-radius: 4px;\r\n        }\r\n        .column-options {\r\n            display: flex;\r\n            justify-content: space-between;\r\n            gap: 10px;\r\n            margin-top: 10px;\r\n        }\r\n        .column-options div {\r\n            flex: 1;\r\n        }\r\n        .add-column-btn, .submit-btn {\r\n            display: block;\r\n            width: 100%;\r\n            padding: 10px;\r\n            background-color: #007bff;\r\n            color: white;\r\n            border: none;\r\n            cursor: pointer;\r\n            font-size: 16px;\r\n            border-radius: 4px;\r\n            margin-top: 20px;\r\n        }\r\n        .add-column-btn:hover, .submit-btn:hover {\r\n            background-color: #0056b3;\r\n        }\r\n        .error {\r\n            color: red;\r\n            font-weight: bold;\r\n            margin-top: 10px;\r\n            text-align: center;\r\n        }\r\n        button.home {\r\n            background-color: #007bff;\r\n            color: white;\r\n            border: none;\r\n            padding: 12px 25px;\r\n            border-radius: 5px;\r\n            font-size: 16px;\r\n            cursor: pointer;\r\n            transition: background-color 0.3s ease;\r\n            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\r\n            margin-bottom: 30px;\r\n        }\r\n\r\n        button.home:hover {\r\n            background-color: #0056b3;\r\n        }'),
('displayTable', 'body {\r\n            font-family: \'Open Sans\', sans-serif;\r\n            background-color: #f4f5f7;\r\n            color: #333;\r\n            padding: 40px;\r\n            margin: 0;\r\n            box-sizing: border-box;\r\n            line-height: 1.6;\r\n            position: relative;\r\n        }\r\n\r\n        /* Home Button */\r\n        button.home {\r\n            background-color: #007bff;\r\n            color: white;\r\n            border: none;\r\n            padding: 12px 25px;\r\n            border-radius: 5px;\r\n            font-size: 16px;\r\n            cursor: pointer;\r\n            transition: background-color 0.3s ease;\r\n            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\r\n            margin-bottom: 30px;\r\n        }\r\n\r\n        button.home:hover {\r\n            background-color: #0056b3;\r\n        }\r\n\r\n        /* Delete Table Button */\r\n        form.delete-form {\r\n            position: absolute;\r\n            top: 20px;\r\n            right: 20px;\r\n        }\r\n\r\n        button.delete-table {\r\n            background-color: #dc3545;\r\n            color: white;\r\n            border: none;\r\n            padding: 12px 25px;\r\n            border-radius: 5px;\r\n            font-size: 16px;\r\n            cursor: pointer;\r\n            transition: background-color 0.3s ease;\r\n            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\r\n        }\r\n\r\n        button.delete-table:hover {\r\n            background-color: #c82333;\r\n        }\r\n\r\n        /* Page Title */\r\n        h1 {\r\n            color: #444;\r\n            font-size: 28px;\r\n            text-align: center;\r\n            margin-bottom: 30px;\r\n        }\r\n\r\n        /* Table Styles */\r\n        table {\r\n            width: 100%;\r\n            border-collapse: collapse;\r\n            margin-top: 20px;\r\n            background-color: #ffffff;\r\n            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);\r\n            border-radius: 8px;\r\n            overflow: hidden;\r\n        }\r\n\r\n        th {\r\n            background-color: #007bff;\r\n            color: white;\r\n            padding: 12px;\r\n            font-size: 18px;\r\n            text-align: left;\r\n        }\r\n\r\n        td {\r\n            padding: 12px;\r\n            font-size: 16px;\r\n            text-align: left;\r\n            border-bottom: 1px solid #e0e0e0;\r\n        }\r\n\r\n        tr:nth-child(even) td {\r\n            background-color: #f9fafb;\r\n        }\r\n\r\n        tr:hover td {\r\n            background-color: #f1f5f9;\r\n        }\r\n\r\n        td[colspan] {\r\n            text-align: center;\r\n            font-style: italic;\r\n        }\r\n\r\n        /* Responsive Design */\r\n        @media (max-width: 768px) {\r\n            body {\r\n                padding: 20px;\r\n            }\r\n\r\n            table, th, td {\r\n                font-size: 14px;\r\n            }\r\n\r\n            button.home, button.delete-table {\r\n                width: 100%;\r\n            }\r\n\r\n            h1 {\r\n                font-size: 24px;\r\n            }\r\n        }'),
('erDiagram', 'body {\r\n            font-family: \'Open Sans\', sans-serif;\r\n            background-color: #f4f5f7;\r\n            color: #333;\r\n            padding: 40px;\r\n            margin: 0;\r\n            box-sizing: border-box;\r\n            line-height: 1.6;\r\n        }\r\n        button.home {\r\n            background-color: #007bff;\r\n            color: white;\r\n            border: none;\r\n            padding: 12px 25px;\r\n            border-radius: 5px;\r\n            font-size: 16px;\r\n            cursor: pointer;\r\n            transition: background-color 0.3s ease;\r\n            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\r\n            margin-bottom: 30px;\r\n        }\r\n\r\n        button.home:hover {\r\n            background-color: #0056b3;\r\n        }\r\n        .er-container {\r\n            display: flex;\r\n            flex-direction: column;\r\n            align-items: center;\r\n        }\r\n        .table-box {\r\n            border: 2px solid #007bff;\r\n            border-radius: 8px;\r\n            padding: 20px;\r\n            margin: 20px;\r\n            background-color: #fff;\r\n            width: 300px;\r\n            text-align: center;\r\n        }\r\n        .table-box h2 {\r\n            color: #007bff;\r\n            margin-bottom: 20px;\r\n        }\r\n        .columns {\r\n            list-style: none;\r\n            padding: 0;\r\n        }\r\n        .columns li {\r\n            margin: 10px 0;\r\n        }\r\n        .foreign-keys {\r\n            margin-top: 30px;\r\n        }'),
('index', '/* Global Styles */\nbody {\n    font-family: \'Open Sans\', sans-serif;\n    background-color: #f4f5f7;\n    color: #333;\n    text-align: center;\n    padding: 50px;\n    margin: 0;\n    box-sizing: border-box;\n}\n\n/* Container for layout */\n.container {\n    max-width: 1200px;\n    margin: 0 auto;\n    padding: 20px;\n    display: flex;\n    flex-direction: column;\n    align-items: center;\n    gap: 30px;\n}\n\n/* Create Table Button */\n.createTable {\n    background-color: #0062cc;\n    color: white;\n    border: none;\n    padding: 12px 25px;\n    border-radius: 5px;\n    font-size: 16px;\n    font-weight: bold;\n    cursor: pointer;\n    transition: background-color 0.3s ease;\n    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\n    margin-bottom: 20px;\n}\n\n.createTable:hover {\n    background-color: #004bb5;\n}\n\n/* Tables Styles */\n.tables {\n    width: 80%;\n    border-collapse: collapse;\n    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);\n    background-color: #ffffff;\n    border-radius: 8px;\n    overflow: hidden;\n    margin: 0 auto;\n}\n\n.tables th {\n    background-color: #0062cc;\n    color: white;\n    padding: 15px;\n    text-align: left;\n    font-size: 18px;\n}\n\n.tables td {\n    padding: 15px;\n    border-bottom: 1px solid #e0e0e0;\n    text-align: center;\n    font-size: 16px;\n    transition: background-color 0.3s ease;\n}\n\n.tables tr:hover td {\n    background-color: #f1f5f9;\n}\n\n.tables tr:nth-child(even) td {\n    background-color: #f9fafb;\n}\n\n/* Button inside table cells */\n.custom-button {\n    background-color: #28a745;\n    color: white;\n    border: none;\n    padding: 10px 20px;\n    border-radius: 5px;\n    cursor: pointer;\n    transition: background-color 0.3s ease;\n    font-size: 14px;\n    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\n}\n\n.custom-button:hover {\n    background-color: #218838;\n}\n\n.er-button {\n    background-color: #17a2b8;\n    color: white;\n    border: none;\n    padding: 10px 20px;\n    border-radius: 5px;\n    cursor: pointer;\n    margin-left: 10px;\n    transition: background-color 0.3s ease;\n    font-size: 14px;\n    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\n}\n\n.er-button:hover {\n    background-color: #138496;\n}\n\n.all-diagrams-button {\n    background-color: #ffc107;\n    color: white;\n    border: none;\n    padding: 10px 20px;\n    border-radius: 5px;\n    cursor: pointer;\n    margin-left: 10px;\n    transition: background-color 0.3s ease;\n    font-size: 14px;\n    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);\n}\n\n.all-diagrams-button:hover {\n    background-color: #d39e00;\n}\n\nfooter {\n    margin-top: 50px;\n}\n\nfooter p {\n    font-size: 14px;\n}\n\nfooter a {\n    text-decoration: none;\n    color: #0062cc;\n    font-weight: bold;\n}\n\n/* Responsive Design */\n@media (max-width: 768px) {\n    .tables {\n        width: 100%;\n    }\n\n    .createTable {\n        width: 100%;\n    }\n}\n');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
