<xml version="1.0" encoding="UTF-8">
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    @foreach($links as $link)
        <url>
            <loc>{{$link['url']}}</loc>
            @if(isset($link['date']) && $link['date'])
                <lastmod>{{$link['date']}}</lastmod>
            @endif
            @if(isset($link['changefreq']) && $link['changefreq'])
                <changefreq>{{$link['changefreq']}}</changefreq>
            @endif
            @if(isset($link['priority']) && $link['priority'])
                <priority>{{$link['priority']}}</priority>
            @endif
        </url>
    @endforeach
</urlset>
</xml>