import os
import re

def scan_js_credentials(path):
    credential_files = []
    pattern = re.compile(r'["\'](token|password|secret|admin)[^"\']*["\']', re.I)
    for root, _, files in os.walk(path):
        for file in files:
            if file.endswith('.js'):
                full_path = os.path.join(root, file)
                with open(full_path, 'r') as f:
                    content = f.read()
                    if pattern.search(content):
                        credential_files.append(full_path)
    return credential_files

found = scan_js_credentials('scripts')
if found:
    print("JS files with hardcoded credentials found:")
    for file in found:
        print(file)
else:
    print("No hardcoded credentials found in JS files.")

