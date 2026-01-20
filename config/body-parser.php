<?php

// PHP can't parse the request body from a PUT request with a content type multipart/form-data.
// Source: https://stackoverflow.com/a/9469615
return [
    'multipart/form-data' => static function ($input) {
        // Parse multipart/form-data payload from raw input string and return only form fields.
        // Note: Files are NOT handled here; access them via $request->getUploadedFiles().
        if ($input === '' || $input === null) {
            return null;
        }

        // Determine boundary from the first line of the raw payload
        $boundaryEndPos = strpos($input, "\r\n");
        if ($boundaryEndPos === false) {
            return null;
        }
        $boundary = substr($input, 0, $boundaryEndPos);

        if ($boundary === '' || strlen($boundary) < 2 || $boundary[0] !== '-' || $boundary[1] !== '-') {
            // Not a valid multipart body
            return null;
        }

        // Split into parts and ignore the prologue
        $parts = array_slice(explode($boundary, $input), 1);
        $data = [];

        foreach ($parts as $part) {
            // Trim leading CRLF
            $part = ltrim($part, "\r\n");

            // Last part ends with "--\r\n" or just "--"
            if ($part === "--\r\n" || $part === '--') {
                break;
            }

            // Separate headers and body
            $separatorPos = strpos($part, "\r\n\r\n");
            if ($separatorPos === false) {
                continue;
            }

            $raw_headers = substr($part, 0, $separatorPos);
            $body = substr($part, $separatorPos + 4);

            // Parse headers into an associative array
            $headers = [];
            foreach (explode("\r\n", $raw_headers) as $headerLine) {
                if (strpos($headerLine, ':') === false) {
                    continue;
                }
                [$hName, $hValue] = explode(':', $headerLine, 2);
                $headers[strtolower(trim($hName))] = ltrim($hValue, ' ');
            }

            // We need content-disposition for field name (and optional filename)
            if (!isset($headers['content-disposition'])) {
                continue;
            }

            if (!preg_match(
                '/^(.+); *name="([^"]+)"(?:; *filename="([^"]*)")?/',
                $headers['content-disposition'],
                $matches
            )) {
                continue;
            }

            $name = $matches[2];
            $filename = $matches[3] ?? null;

            // Skip files here; PSR-7 uploaded files should be read from $request->getUploadedFiles()
            if ($filename !== null && $filename !== '') {
                continue;
            }

            // Remove trailing CRLF that precedes the boundary
            $value = rtrim($body, "\r\n");

            $data[$name] = $value;
        }

        return !empty($data) ? $data : null;
    },
];
