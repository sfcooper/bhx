<?xml version="1.0" encoding="ISO-8859-1"?><!-- DWXMLSource="http://pipes.yahoo.com/pipes/pipe.run?_id=7a60146c6f9fb22625525be6983a6503&_render=rss" --><!DOCTYPE xsl:stylesheet  [	<!ENTITY nbsp   "&#160;">	<!ENTITY copy   "&#169;">	<!ENTITY reg    "&#174;">	<!ENTITY trade  "&#8482;">	<!ENTITY mdash  "&#8212;">	<!ENTITY ldquo  "&#8220;">	<!ENTITY rdquo  "&#8221;"> 	<!ENTITY pound  "&#163;">	<!ENTITY yen    "&#165;">	<!ENTITY euro   "&#8364;">]><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"><xsl:output method="html" encoding="ISO-8859-1"/><xsl:template match="/"><xsl:value-of select="rss/channel/item/description" disable-output-escaping="yes"/></xsl:template></xsl:stylesheet>