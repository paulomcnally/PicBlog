-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Servidor: 50.63.244.28
-- Tiempo de generación: 08-09-2012 a las 15:31:07
-- Versión del servidor: 5.0.92
-- Versión de PHP: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `picblogme`
--
CREATE DATABASE `picblogme` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `picblogme`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albums`
--

CREATE TABLE `albums` (
  `aid` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `registered` datetime NOT NULL,
  `shorturl` varchar(6) NOT NULL,
  `screen_name` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`aid`),
  KEY `USER` (`screen_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `options`
--

CREATE TABLE `options` (
  `key` varchar(60) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photos`
--

CREATE TABLE `photos` (
  `pid` bigint(20) unsigned NOT NULL auto_increment,
  `pb_name` varchar(40) NOT NULL,
  `short_name` varchar(6) NOT NULL,
  `aid` bigint(20) unsigned NOT NULL,
  `registered` datetime NOT NULL,
  `view_count` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`pid`,`registered`),
  KEY `ALBUM` (`aid`),
  KEY `DATE` (`registered`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `screen_name` varchar(200) NOT NULL,
  `json` text NOT NULL,
  PRIMARY KEY  (`screen_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
