Static HTML export of the supplied Laravel Blade views.

Conversion:
- Blade/Laravel integrations, routes, CSRF, PHP blocks and directives removed.
- JavaScript <script> blocks and inline JS event handlers removed.
- href attributes removed from navigation/anchor elements.
- Stylesheet <link rel="stylesheet" href="..."> references retained.
- Forms retain their visual controls but no action/integration endpoint.
- Dynamic Blade values replaced with representative static UI text.
- Layout inheritance/includes flattened where possible.
- Original directory structure is preserved; .blade.php becomes .html.

These files are intended as UI starting points for a new project, not as functional Laravel pages.
