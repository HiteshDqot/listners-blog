<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
  <xsl:template match="/">
    <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <title>XML Sitemap - Listeners Blog</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Outfit:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <style type="text/css">
          body {
            background-color: #0C0C0E;
            color: #FFFFFF;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 40px 20px;
          }
          .container {
            max-width: 1000px;
            margin: 0 auto;
          }
          h1 {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            margin: 0 0 10px 0;
            background: linear-gradient(90deg, #8A2BE2 0%, #FF4D8D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
          }
          p.desc {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 0 0 30px 0;
          }
          p.desc a {
            color: #FF4D8D;
            text-decoration: none;
          }
          p.desc a:hover {
            text-decoration: underline;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            background-color: #13131A;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            overflow: hidden;
          }
          th {
            background-color: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            color: #FFFFFF;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            text-align: left;
            padding: 15px 20px;
          }
          td {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            color: rgba(255, 255, 255, 0.8);
          }
          tr:hover td {
            background-color: rgba(255, 255, 255, 0.01);
          }
          tr:last-child td {
            border-bottom: none;
          }
          a {
            color: #FFFFFF;
            text-decoration: none;
            word-break: break-all;
            transition: color 0.2s ease;
          }
          a:hover {
            color: #FF4D8D;
          }
          .priority-badge {
            display: inline-block;
            padding: 4px 8px;
            background-color: rgba(138, 43, 226, 0.15);
            color: #8A2BE2;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
          }
          .priority-high {
            background-color: rgba(255, 77, 141, 0.15);
            color: #FF4D8D;
          }
        </style>
      </head>
      <body>
        <div class="container">
          <h1>XML Sitemap</h1>
          <p class="desc">
            This is an XML Sitemap, generated dynamically to help search engines discover and index the content of this website.<br/>
            You can find more information about XML sitemaps on <a href="https://sitemaps.org" target="_blank" rel="noopener">sitemaps.org</a>.
          </p>
          <table>
            <thead>
              <tr>
                <th width="60%">URL</th>
                <th width="15%">Priority</th>
                <th width="15%">Change Freq.</th>
                <th width="10%">Last Modified (GMT)</th>
              </tr>
            </thead>
            <tbody>
              <xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'"/>
              <xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
              <xsl:for-each select="sitemap:urlset/sitemap:url">
                <xsl:sort select="sitemap:priority" order="descending"/>
                <tr>
                  <td>
                    <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                  </td>
                  <td>
                    <span class="priority-badge">
                      <xsl:if test="number(sitemap:priority) &gt;= 0.8">
                        <xsl:attribute name="class">priority-badge priority-high</xsl:attribute>
                      </xsl:if>
                      <xsl:value-of select="sitemap:priority"/>
                    </span>
                  </td>
                  <td>
                    <xsl:value-of select="sitemap:changefreq"/>
                  </td>
                  <td>
                    <xsl:value-of select="substring(sitemap:lastmod,0,11)"/>
                  </td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
