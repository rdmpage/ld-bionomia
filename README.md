# ld-bionomia
Linked data from Bionomia

List of people can be downloaded from [Downloads](https://bionomia.net/downloads).

We can fetch JSON LD for an id like this: https://bionomia.net/0000-0002-1314-755X/specimens.jsonld

Note that Bionomia has paged results, so the code has been died to fetch more than one page. The first page is stored using just the Bionomia id, but subsequent pages are stored in a file with `-n` appended where `n` is the page number.

## Issues

The Bionomia `@context` originally lacked `sameAs` which meant that `sameAs` links were literals not URIs (see https://github.com/bionomia/bionomia/issues/225). This has since been fixed.
