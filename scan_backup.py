import os
import re

def scan_backup_creds(path):
    backup_files = []
    for root, _, files in os.walk(path):
        for file in files:
            if file.lower() in ['creds.txt', 'passwords.txt', 'backup.txt', 'config.bak']:
                full_path = os.path.join(root, file)
                with open(full_path, 'r') as f:
                    lines = f.readlines()
                    for line in lines:
                        # Check if line has 3 comma-separated fields
                        parts = line.strip().split(',')
                        if len(parts) == 3:
                            username, email, password = parts
                            # Look for keywords in username or email
                            if re.search(r'(admin|user|backup)', username, re.I) or re.search(r'(admin|user|backup)', email, re.I):
                                backup_files.append(full_path)
                                break  # Stop checking this file, we found a match
    return backup_files

found_files = scan_backup_creds('backup')
if found_files:
    print("Exposed credentials files found:")
    for f in found_files:
        print(f)
else:
    print("No exposed credentials files found.")

